@extends('irrigacao.layout.master')
@section('content')



    <span class="flex justify-center ">
        @if (Session::has('message'))
            <div class="m-2 text-center text-red-900 bg-red-200 rounded-sm shadow-md">{{ Session::get('message') }}</div>
        @endif

        <div class="grid grid-cols-3 gap-4">
            @foreach ($hortas as $horta)
                <a href="/horta/{{ $horta->id }}">
                    <div
                        class="p-5 m-5 font-extrabold text-center text-green-900 bg-green-300 border-2 border-green-400 rounded-md shadow-md hover:bg-green-500 w-52">
                        {{ $horta->nome }}</div>
                </a>
            @endforeach

        </div>





    </span>

@endsection
