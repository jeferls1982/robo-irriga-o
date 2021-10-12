@extends('irrigacao.layout.master')
@section('content')

    <section class="flex flex-col m-5">
        <span class="p-3 font-semibold text-green-900 bg-green-100 border border-green-300 rounded-md shadow-md">
            Bem vindo ao sistema de irrigação
        </span>

        <p class="flex flex-wrap justify-center">
            <a class="flex items-center justify-around p-5 m-5 text-3xl text-white bg-green-900 rounded-md shadow-sm w-96 hover:bg-green-700"
                href="/horta">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                  </svg>
                <span>
                    Hortas
                </span>
            </a>
            <a class="flex items-center justify-around p-5 m-5 text-3xl text-white bg-green-900 rounded-md shadow-sm w-96 hover:bg-green-700"
                href="/horta/create">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    Nova Horta

                </span>
            </a>
        </p>


    </section>

@endsection
