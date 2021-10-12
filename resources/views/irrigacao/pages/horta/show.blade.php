@extends('irrigacao.layout.master')
@section('content')
    <p class="p-1 text-center border-2 border-green-400 rounded-sm shadow-md">Nome da horta: <span class="font-black">{{ $horta->nome }}</span></p>
    <section class="flex flex-col m-5">

        @if (Session::has('message'))
            <div class="m-2 text-center text-red-900 bg-red-200 rounded-sm shadow-md">{{ Session::get('message') }}</div>
        @endif
        <div class="w-full rounded-sm shadow-md">
            <div class="flex flex-wrap justify-around">


                <div id="matriz"
                    class="p-10 text-base border border-green-700 rounded shadow-md md:text-sm bg-green-50 md:leading-loose ">
                    <p class="w-full font-semibold text-center text-green-900 bg-green-300 border-2 border-green-400 rounded-sm shadow-md"
                        onclick="showMatriz()">
                        Escolha a posição do Robô:</p>
                    @include('irrigacao.pages.robo.forms.form_radio')
                </div>

                <div id="matrizManual"
                    class="p-10 text-base border border-green-700 rounded shadow-md md:text-sm bg-green-50 md:leading-loose ">
                    <p class="w-full font-semibold text-center text-green-900 bg-green-300 border-2 border-green-400 rounded-sm shadow-md"
                        onclick="showManual()">
                        Informe as coordenadas</p>
                    @include('irrigacao.pages.robo.forms.form_coordenadas')
                </div>

            </div>

            <br>
            <div>

            </div>
        </div>
    </section>

@endsection
<script>
    function showManual() {
        document.getElementById('matriz').style = 'display: none'
        document.getElementById('matrizManual').style = 'display: block'
        document.getElementById('formManual').style = 'display: block'


    }

    function showMatriz() {
        document.getElementById('matriz').style = "display : block"
        document.getElementById('matrizManual').style = 'display: none'
        document.getElementById('formManual').style = 'display: none'

    }
</script>
