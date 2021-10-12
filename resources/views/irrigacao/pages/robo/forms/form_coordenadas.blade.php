<div class="flex justify-center w-full mb-3">
    <div>
        @foreach ($horta->canteiros as $canteiro)
            @php
                $l = $canteiro->x;
            @endphp
            @if ($l == 0)
                <br>
            @endif
            <span class="md:text-lg">
                {{ $canteiro->x }},{{ $canteiro->y }}
                |
            </span>

            @php
                $l--;
            @endphp
        @endforeach
    </div>
</div>
<p>
<form action="/robo" id="formManual" method="POST">
    @csrf
    <span id="x">x: <input class="border border-green-500 rounded-sm" onchange="showManual()" type="number" name="x" min="0" max="{{ $max->x }}"
            value="0"></span>
    <span id="y">y: <input class="border border-green-500 rounded-sm" onchange="showManual()" type="number" name="y" min="0" max="{{ $max->y }}"
            value="0"></span><br>
    <input type="hidden" name="radio" value="false">
    <input type="hidden" name="horta_id" value="{{ $horta->id }}">
    <p>@include('irrigacao.pages.robo.forms.select_orientacao')</p>
    <p>@include('irrigacao.pages.robo.forms.input_submit')</p>
</form>
</p>
