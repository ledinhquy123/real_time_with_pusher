@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
                    <ul id="users">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module">
        const allUsers = document.getElementById('users')
        window.axios.get('/api/users').then((response) => {
            const users = response.data.data
            users.forEach((user, index) => {
                const element = document.createElement('li')
                element.setAttribute('id', user.id)
                element.innerText = user.name

                allUsers.appendChild(element)
            });
        })
    </script>

    <script type="module">
        const allUsers = document.getElementById('users')
        Echo.channel('user-created-channel').listen('UserCreated', (e) => {
            const element = document.createElement('li')
            element.setAttribute('id', e.user.id)
            element.innerText = e.user.name
            allUsers.appendChild(element)
        })
        Echo.channel('user-updated-channel').listen('UserUpdated', (e) => {
            const element = document.getElementById(e.user.id)
            element.innerText = e.user.name
        })
        Echo.channel('user-deleted-channel').listen('UserDeleted', (e) => {
            const element = document.getElementById(e.user.id)
            allUsers.removeChild(element)
        })
    </script>
@endpush