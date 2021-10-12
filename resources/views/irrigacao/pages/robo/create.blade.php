@extends('irrigacao.layout.master')
@section('content')
    <h3>Create position initial</h3>
    <p>Horta : {{ $horta['nome'] }}</p>

    <center>
        <p>Informe a posição do Robô:</p>
        <div>
            <form action="/robo" method="POST">
                @csrf
                @foreach ($horta['canteiros'] as $coluna)
                    @foreach ($coluna as $linha)

                        <input type="radio" name="x" value="{{ $linha->posicao['x'] }}">
                        <input type="hidden" name="teste" value="{{ $linha->posicao['y'] }}">


                    @endforeach

                    <br />
                @endforeach
                <select name="orientacao" id="">
                    <option value="">Selecione ... </option>
                    <option value="N">Norte </option>
                    <option value="S">Sul </option>
                    <option value="L">Leste</option>
                    <option value="O">Oeste</option>
                </select>
                <input type="submit">
            </form>

        </div>

        <br>
        <div>

        </div>
    </center>

@endsection
