@extends('irrigacao.layout.master')
@section('content')


    <div class="flex justify-center w-full mt-3">
        <div class="p-10 text-base border border-green-700 rounded shadow-md w-96 md:text-sm bg-green-50 md:leading-loose">
            <p
                class="w-full font-semibold text-center text-green-900 bg-green-300 border-2 border-green-400 rounded-sm shadow-md">
                Por favor, preencha os
                campos</p>
            @if (Session::has('message'))
                <div class="m-2 text-center text-red-900 bg-red-100 rounded-sm">{{ Session::get('message') }}</div>
            @endif
            <form action="/horta" method="POST">
                @csrf
                <p class="flex justify-between m-2"><span class="font-semibold text-green-900">Nome da Horta</span> <input
                        class="w-32 text-center border border-green-200 rounded-sm" type="text" value="" name="nome"
                        autocomplete="off"></p>
                <p class="flex justify-between m-2"><span class="font-semibold text-green-900">Largura: </span><input
                        class="w-32 text-center border border-green-200 rounded-sm" type="number" value="10" name="colunas"
                        autocomplete="off" min="0" max="100"></p>
                <p class="flex justify-between m-2"><span class="font-semibold text-green-900">Comprimento:</span> <input
                        class="w-32 text-center border border-green-200 rounded-sm" type="number" value="10" name="linhas"
                        autocomplete="off" min="0" max="100"></p>
                @include('irrigacao.pages.robo.forms.input_submit')
            </form>
        </div>
    </div>




@endsection
