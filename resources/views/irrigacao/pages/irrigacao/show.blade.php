@extends('irrigacao.layout.master')
@section('content')

    <div class="flex justify-center w-full mt-3 ">
        <div class="p-10 text-base border border-green-700 rounded shadow-md md:text-sm bg-green-50 md:leading-loose ">
            <p
                class="w-full font-semibold text-center text-green-900 bg-green-300 border-2 border-green-400 rounded-sm shadow-md">
                Para iniciar o trabalho, clique em iniciar</p>
            <div class="flex justify-center">
                <div>
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
                            <span class="p-2 text-center text-white bg-red-600 rounded-sm">
                            @else
                                @if ($canteiro->active)
                                    <span class="p-2 bg-yellow-300 ">
                                    @else
                                        <span class="p-2 bg-green-300">
                                @endif

                        @endif
                        @if ($canteiro->active)

                        @endif
                        @if ($robo)
                            RB
                        @else
                            {{ $canteiro->x }},{{ $canteiro->y }}
                        @endif


                        </span>

                        @php
                            $l--;
                        @endphp
                    @endforeach
                </div>
            </div>
            <p class="w-full mt-3 text-center"><a
                    class="p-2 text-center text-white bg-green-700 rounded-sm shadow-sm hover:bg-green-600"
                    href="/irrigacao/iniciar/{{ $irrigacao->id }}">Iniciar</a></p>
        </div>

    </div>
@endsection
