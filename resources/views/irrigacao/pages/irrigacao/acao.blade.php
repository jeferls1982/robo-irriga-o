@extends('irrigacao.layout.master')
@section('content')


    <input type="hidden" id="pendente" value="{{ $pendente }}">
    <div class="flex justify-center w-full mt-3 ">

        <div class="p-10 text-base border border-green-700 rounded shadow-md md:text-sm bg-green-50 md:leading-loose ">
            <p id="msg"
                class="w-full font-semibold text-center text-green-900 bg-green-300 border-2 border-green-400 rounded-sm shadow-md">
            </p>

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
                    <!--  Se o robo estiver na posicao  -->
                    @if ($robo && $canteiro->irrigado)
                        <!--  Se o robo estiver na posicao e estiver irrigado  -->
                        <span class="p-2 font-black text-red-900 bg-blue-400 ">
                        @else
                            <!--  Se o robo estiver na posicao e NÂO estiver irrigado  -->
                            <span class="p-2 font-medium text-white bg-red-600 ">
                    @endif



                @else
                    @if ($canteiro->active)
                        <!--  Se o robo NÃO estiver na posicao e estiver irrigado  -->
                        @if ($canteiro->irrigado)
                            <span class="p-2 text-white bg-blue-500 ">
                            @else
                                <!--  canteiros que precisam ser irrigados  -->
                                <span class="p-2 bg-yellow-200 ">
                        @endif

                    @elseif ($canteiro->caminho)
                        <span class="p-2 bg-green-100 ">
                        @elseif ($canteiro->inicio_robo)
                            <span class="p-2 font-extrabold text-red-900">
                            @else
                                <!--  canteiros que não serão irrigados  -->
                                <span class="p-2 bg-green-300 ">
                    @endif
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
    <p class="w-full text-center">Orientação do Robo: {{ $orientacao }}</p>

    <span class="flex justify-center w-full mt-3">
        <p class="max-w-xl p-3 text-base text-center border-2 border-blue-400 rounded-md shadow-md md:text-sm"
            style="background-color: rgba(0, 81, 255, 0.24)">
            @foreach ($string_movimentos as $mov)
                {{ $mov }} ,
            @endforeach
        </p>
    </span>

    <script>
        let msg = document.getElementById('msg');
        let pendente = document.getElementById('pendente').value;
        if (pendente) {
            msg.innerHTML = "Trabalhando..."
            setTimeout(function() {
                window.location.reload(1);
            }, 1000); // 1 seg
        } else {
            msg.innerHTML = "Fim do trabalho..."
        }
    </script>

@endsection
