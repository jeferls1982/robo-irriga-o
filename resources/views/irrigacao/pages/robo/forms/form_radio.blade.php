<div class="flex justify-center w-full mb-3">
    <div>
        <form action="/robo" method="POST">
            @csrf
            @foreach ($horta->canteiros as $canteiro)
                @php
                    $l = $canteiro->x;
                @endphp
                @if ($l == 0)
                    <br>
                @endif
                <span class="md:text-lg">

                    {{ $canteiro->x }},{{ $canteiro->y }}

                    <input type="radio" onchange="showMatriz()" name="posicao_robo" value="{{ $canteiro->id }}">

                </span>
                @php
                    $l--;
                @endphp
            @endforeach
            <p>@include('irrigacao.pages.robo.forms.select_orientacao')</p>
            <input type="hidden" name="radio" value="true">
            <input type="hidden" name="horta_id" value="{{ $horta->id }}">
            <p>@include('irrigacao.pages.robo.forms.input_submit')</p>
        </form>
    </div>
</div>
