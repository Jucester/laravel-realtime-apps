@extends('layouts.app')

@push('styles')
    <style>
        @keyframes rotate {
            from {
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
                <div class="card-header"> Roulette </div>

                <div class="card-body">
                       <div class="text-center"> 
                           <img class="refresh" src="{{ asset('img/circle.png') }}" alt="circle image" id="circle" width="250" height="250">

                           <p class="display-1 d-none text-primary" id="winner"> 10 </p>
                        </div>
                        <hr>

                        <div class="text-center">
                            <label for="bet" class="font-weight-bold h5"> Your bet </label>
                            <select name="bet" id="bet" class="custom-select col-auto">
                                <option value="" selected> Not in </option>
                                @foreach (range(1, 12) as $item)
                                    <option> {{ $item }} </option>
                                @endforeach
                            </select>
                            <hr>
                            <p class="font-weight-bold h5"> Remaining Time </p>
                            <p id="timer" class="h5 text-danger"> Waiting </p>
                            <hr>
                            <p id="result" class="h1"> </p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script>

            const circle = document.getElementById('circle');
            const timer = document.getElementById('timer');
            const bet = document.getElementById('bet');
            const winner = document.getElementById('winner');
            const result = document.getElementById('result');

            console.log('Working')

            Echo.channel('game')
                .listen('RemainingTimeChange', (e) => {
                    console.log(e.time);
                    timer.innerText = e.time;

                    circle.classList.add('refresh');

                    winner.classList.add('d-non');

                    result.innerText = '';
                    result.classList.remove('text-success');
                    result.classList.remove('text-danger');
                })
                .listen('WinnerNumberGenerated', (e) => {

                    circle.classList.remove('refresh');

                    let winnerNumber = e.number;
                
                    winner.innerText = winnerNumber;

                    winner.classList.remove('d-non');

                    let userBet = bet[bet.selectedIndex].innerText;

                    if (userBet == winnerNumber) {
                        result.innerText = 'You win';
                        result.classList.add('text-success');
                    } else {
                        result.innerText = 'You lose';
                        result.classList.add('text-danger');
                    }

                })
    </script>
   
@endpush
