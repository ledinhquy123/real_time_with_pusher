@extends('layouts.app')

@push('style')
    <style> 
        @keyframes rotate {
            from{
                transform: rotate(0deg)
            }
            to {
                transform: rotate(360deg)
            }
        }

        .refresh {
            animation: rotate 1.5s linear infinite;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Game') }}</div>

                <div class="card-body">
                    <div class="text-center">
                        <img id="circle" src="{{ asset('imgs/circle.png') }}" height="250" width="250"/>
                        <p id="winner" class="display-1 text-primary"></p>

                        <hr/>

                        <div class="text-center">
                            <label for="bet" class="font-weight-bold h5">Betting</label>
                            <select id="bet" class="custom-select col-auto">
                                <option selected>None</option>
                                @foreach (range(1, 12) as $number)
                                    <option value="{{ $number }}">{{ $number }}</option>
                                @endforeach
                            </select>
                        
                            <hr/>
                            <p class="font-weight-bold h5">Remaining Time</p>
                            <p id="timer" class="h5 text-danger"></p>
    
                            <hr/>
    
                            <div id="result" class="h1"></div>
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
        const circleElement = document.getElementById('circle')
        const timerElement = document.getElementById('timer')
        const winnerElement = document.getElementById('winner')
        const betElement = document.getElementById('bet')
        const resultElement = document.getElementById('result')

        Echo.channel('game')
            .listen('RemainingTimeChanged', (e) => {
                circleElement.classList.add('refresh')
                winnerElement.classList.add('d-none')

                resultElement.classList.remove('text-success')
                resultElement.classList.remove('text-danger')


                timerElement.innerText = e.time
                winnerElement.innerText = ''
                resultElement.innerText = ''
            })
            .listen('WinnerNumberGenerated', (e) => {
                circleElement.classList.remove('refresh')
                winnerElement.classList.remove('d-none')
                resultElement.classList.remove('d-none')

                winnerElement.innerText = e.number

                if(betElement[betElement.selectedIndex].value == e.number) {
                    resultElement.innerText = 'You win'
                    resultElement.classList.add('text-success')
                }else {
                    resultElement.innerText = 'You lose'
                    resultElement.classList.add('text-danger')
                }
            })  
    </script>
@endpush