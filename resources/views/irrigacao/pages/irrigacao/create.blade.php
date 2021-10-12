@extends('irrigacao.layout.master')
@section('content')



    <div class="flex justify-center w-full mt-3 ">
        <div class="p-10 text-base border border-green-700 rounded shadow-md md:text-sm bg-green-50 md:leading-loose ">
            <p class="w-full font-semibold text-center text-green-900 bg-green-300 border-2 border-green-400 rounded-sm shadow-md">
                Selecione os canteiros a ser irrigados
            </p>

            @if (Session::has('message'))
                <div class="m-2 text-center text-red-900 bg-red-100 rounded-sm">{{ Session::get('message') }}</div>
            @endif
            <div class="flex justify-center">
                <form action="/irrigacao" method="POST">
                    @csrf
                    @foreach ($horta->canteiros as $canteiro)
                        @php
                            $robo = false;
                            $l = $canteiro->x;
                            if ($horta->robo->x == $canteiro->x && $horta->robo->y == $canteiro->y) {
                                $robo = true;
                            }
                        @endphp
                        @if ($canteiro->x == 0)
                            <br>
                        @endif
                        @if ($robo)
                            <span class="text-white bg-red-600">
                            @else
                                <span>
                        @endif
                        {{ $canteiro->x }},{{ $canteiro->y }}
                        <input type="checkbox" name="irrigar[]" value="{{ $canteiro->id }}">
                        </span>
                        |
                        @php
                            $l--;
                        @endphp
                    @endforeach
                    <p>@include('irrigacao.pages.robo.forms.input_submit')</p>
                </form>
            </div>
        </div>
    </div>
    </div>
    <span class="flex justify-center m-3">
        <span class="p-2 font-semibold text-white bg-red-600">Posição do Robo</span>
    </span>


@endsection
