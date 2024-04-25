@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Chat') }}</div>

                <div class="card-body">
                    <div class="row p-2">
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 border rounded-lg p-3">
                                    <ul id="messages" class="list-unstyled overflow-auto" style="min-height: 45vh">
                                    </ul>
                                </div>

                                <form>
                                    @csrf
                                    <div class="row p-3">
                                        <div class="col-10">
                                            <input type="text" id="message" class="form-control" name="message">
                                        </div>

                                        <div class="col-2">
                                            <button class="btn btn-primary w-100" id="send" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-2">
                            <p><strong>Online users list</strong></p>
                            <ul id="users" class="list-unstyled overflow-auto text-info" style="min-height: 45vh">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module">
        const usersElement = document.getElementById('users')
        const messagesElement = document.getElementById('messages')

        Echo.join('chat')
            .here((users) => {
                users.forEach((user, index) => {
                    const element = document.createElement('li')
                    element.setAttribute('id', user.id)
                    element.innerText = user.name

                    usersElement.appendChild(element)
                });
            })
            .joining((user) => {
                console.log(user, 'joining');
                const element = document.createElement('li')
                element.setAttribute('id', user.id)
                element.innerText = user.name

                usersElement.appendChild(element)
            })
            .leaving((user) => { 
                console.log(user, 'leaving');
                const element = document.getElementById(user.id)

                usersElement.removeChild(element)
            })


            Echo.channel('chat').listen('TestMessageSent', (e) => {
                console.log(e)
                const element = document.createElement('li')
                element.innerText = e.user.name + ': ' + e.message

                messagesElement.appendChild(element)
            })
    </script>

    <script type="module">
        const messageElement = document.getElementById('message')
        const sendElement = document.getElementById('send')
        const messagesElement = document.getElementById('messages')

        sendElement.addEventListener('click', (e) => {
            e.preventDefault();
            
            window.axios.post('chat/message', {
                message: messageElement.value
            })

            messageElement.value = ''
        })
    </script>
@endpush