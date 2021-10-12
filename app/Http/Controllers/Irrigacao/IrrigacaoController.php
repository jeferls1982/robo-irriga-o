<?php

namespace App\Http\Controllers\Irrigacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Irrigacao\Horta;
use App\Models\Irrigacao\Canteiro;
use App\Models\Irrigacao\Irrigacao;
use App\Models\Irrigacao\Robo;
use Illuminate\Support\Facades\Session;

class IrrigacaoController extends Controller
{
    private $horta;
    private $canteiro;
    private $irrigacao;
    public function __construct(Horta $horta, Canteiro $canteiro, Irrigacao $irrigacao)
    {
        $this->horta = $horta;
        $this->canteiro = $canteiro;
        $this->irrigacao = $irrigacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = session()->get('irrigacao_id');
        $irrigacao = $this->irrigacao->find($id);
        $horta = $this->horta->with('canteiros')->with('robo')->find($irrigacao->horta_id);
        $orientacao = Robo::getOrientacao($horta->robo->orientacao);

        $pendente = session()->get('pendente');
        $string_movimentos = json_decode(session()->get('string_movimentos'));
        if (session()->get('inicial') == true) {
            session()->put('inicial', false);
            return view('irrigacao.pages.irrigacao.acao', compact('horta', 'pendente', 'string_movimentos','orientacao'));
        } else {
            $this->acao($irrigacao, $horta->robo);
            return view('irrigacao.pages.irrigacao.acao', compact('horta', 'pendente', 'string_movimentos','orientacao'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->put('pendente', true);
        $string_movimentos = [];
        session()->put('string_movimentos', json_encode($string_movimentos));

        if ($request['irrigar'] == null) {
            Session::flash('message', "Selecione pelo menos uma posição!");
            return back();
        }
        foreach ($request['irrigar'] as $id) {
            $canteiro = $this->canteiro->find($id);
            $horta_id = $canteiro->horta_id;
            $canteiro->update(['active' => true, 'caminho' => true]);
            $canteiros[] = $canteiro;
        }
        $canteiros = json_encode($canteiros);
        $this->irrigacao->array_selecionados = $canteiros;
        $this->irrigacao->horta_id = $horta_id;
        $this->irrigacao->save();

        return $this->showIrrigacao($this->irrigacao->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horta = $this->horta->with('canteiros')->with('robo')->find($id);
        return view('irrigacao.pages.irrigacao.create', compact('horta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showIrrigacao($id)
    {
        $irrigacao = $this->irrigacao->with('horta')->find($id);
        $horta = $this->horta->with('canteiros')->with('robo')->find($irrigacao->horta_id);

        return view('irrigacao.pages.irrigacao.show', compact('horta', 'irrigacao'));
    }

    public function iniciarIrrigacao($id)
    {
        $irrigacao = $this->irrigacao->find($id);
        $posicoes_a_irrigar = json_decode($irrigacao->array_selecionados);
        $horta = $this->horta->with('robo')->find($irrigacao->horta_id);
        $robo = $horta->robo;
        // busco as posicoes e o caminho a ser seguido baseado na posicao atual do robo
        $caminho = $this->getCaminho($posicoes_a_irrigar, $robo);

        $irrigacao->update(['caminho' => json_encode($caminho)]);

        session()->put('irrigacao_id', $irrigacao->id);
        session()->put('inicial', true);
        return redirect('/irrigacao');
    }

    public function acao($irrigacao, $robo)
    {
        $caminho = json_decode($irrigacao->caminho);
        foreach ($caminho as $posicao) {
            $robo->proxX = $posicao->x;
            $robo->proxY = $posicao->y;
            $robo->update();
            //Se o robo já estiver na posição a ser irrigada, já irriga
            if ($posicao->x == $robo->x && $posicao->y == $robo->y) {
                $this->canteiro->where('id', $posicao->id)->update(['irrigado' => true]);
                $this->setStringAcao('I');
                // quando o robo chega na posicao, removo a primeira posicao do array caminho
                // senão o robo não se move
                array_shift($caminho);
                if (count($caminho) == 0) {
                    session()->put('pendente', false);
                }
                $irrigacao->caminho = json_encode($caminho);
                $irrigacao->update();
                $robo->update();
            }

            // incremento as posicoes do robo e seto a orientaçãp
            //------------------------------------------movimentação no eixo x
            if ($robo->proxX > $robo->x && $robo->proxX != $robo->x) {
                $orientacao = 'l';
                //se a orientacao do robo estiver de acordo com a orientação
                // da condição, aí sim incremento
                // serve para todos os ifs abaixo
                if ($this->movimentar($robo, $orientacao)) {
                    $robo->increment('x');
                    $this->canteiro->where('x',$robo->x)->where('y',$robo->y)->update(['caminho'=>true]);

                }
                return;
            } elseif ($robo->proxX < $robo->x && $robo->proxX != $robo->x) {
                $orientacao = 'o';
                if ($this->movimentar($robo, $orientacao)) {
                    $robo->decrement('x');
                    $this->canteiro->where('x',$robo->x)->where('y',$robo->y)->update(['caminho'=>true]);
                }
                return;
            }
            //------------------------------------------movimentação no eixo y
            if ($robo->proxY > $robo->y && $robo->proxY != $robo->y) {
                $orientacao = 'n';
                if ($this->movimentar($robo, $orientacao)) {
                    $robo->increment('y');
                    $this->canteiro->where('x',$robo->x)->where('y',$robo->y)->update(['caminho'=>true]);
                }
                return;
            } elseif ($robo->proxY < $robo->y && $robo->proxY != $robo->y) {

                $orientacao = 's';
                if ($this->movimentar($robo, $orientacao)) {
                    //dd($robo);
                    $robo->decrement('y');
                    $this->canteiro->where('x',$robo->x)->where('y',$robo->y)->update(['caminho'=>true]);
                }

                return;
            }
            return;
        }
    }
    //------retorno true se atender as condicoes para se movimentar
    // de acordo com a orientação do robo
    public function movimentar($robo, $orientacao)
    {

        $move = $this->getOrientacao($robo, $orientacao);
        while ($move != "M") {
            //-----------------------espero M, D ou E para a string de movimentos
            $move = $this->getOrientacao($robo, $orientacao);

            //dd('aqui');
            if ($move != 'M') {
                $this->setStringAcao($move);
            }

            //------------------------atualizo a orientação atual do robo
            $robo = $this->setOrientacao($robo, $move);

        }
        $this->setStringAcao($move);
        return true;
    }
    //-------------apontando o robo conforme a orientação do proximo canteiro
    public function getOrientacao($robo, $o)
    {

        if ($robo->orientacao == $o) {

            return 'M';
        } elseif (
            //lado direito
            $robo->orientacao == 'n' && $o == 'l' ||
            $robo->orientacao == 'l' && $o == 's' ||
            $robo->orientacao == 's' && $o == 'o' ||
            $robo->orientacao == 'o' && $o == 'n' ||
            //lado oposto
            $robo->orientacao == 'n' && $o == 's' ||
            $robo->orientacao == 'l' && $o == 'o' ||
            $robo->orientacao == 's' && $o == 'n' ||
            $robo->orientacao == 'o' && $o == 'l'
        ) {

            return 'D';
        } else {
            //lado esquerdo

            return 'E';
        }

    }
    //--------------------atualizo a orientação atual do robo
    public function setOrientacao($robo, $move)
    {
        if (
            $robo->orientacao == 'n' && $move == "D" ||
            $robo->orientacao == 's' && $move == "E"
        ) {
            $robo->orientacao = 'l';
        } elseif (
            $robo->orientacao == 'l' && $move == "D" ||
            $robo->orientacao == 'o' && $move == "E"
        ) {
            $robo->orientacao = 's';
        } elseif (
            $robo->orientacao == 's' && $move == "D" ||
            $robo->orientacao == 'n' && $move == "E"
        ) {
            $robo->orientacao = 'o';
        } elseif (
            $robo->orientacao == 'o' && $move == "D" ||
            $robo->orientacao == 'l' && $move == "E"
        ) {
            $robo->orientacao = 'n';
        }
        $robo->update();
        return $robo;
    }


    //-----------------comparo as posiões informadas para ser irrigadas e defino o caminho
    public function getCaminho($posicoes_a_irrigar, $posicao_robo)
    {
        foreach ($posicoes_a_irrigar as $posicao) {
            $x = $posicao->x - $posicao_robo->x;
            $y = $posicao->y - $posicao_robo->y;
            //pego a diferenca entre os pontos da horta para analisar qual é mais próximo
            // baseado no ponto inicial
            $caminho[$posicao->id] = $this->getDiferenca($x, $y);
        }
        //ordeno pelo valor para saber qual é o mais próximo
        asort($caminho);
        $caminho = $this->posicoesCaminho($caminho);
        return $caminho;
    }
    //------busco as posicoes de acordo com o id informado
    public function posicoesCaminho($array_id_posicao)
    {
        foreach ($array_id_posicao as $key => $id) {
            $caminho[] = $this->canteiro->find($key);
        }
        return $caminho;
    }

    //------calculo a diferenca entre dois pontos
    public function getDiferenca($x, $y)
    {
        if ($x < 0) {
            $x = $x * -1;
        }
        if ($y < 0) {
            $y = $y * -1;
        }
        return $x + $y;
    }

    public function setStringAcao($move)
    {
        $string_movimentos = json_decode(session()->get('string_movimentos'));
        $string_movimentos[] = $move;
        session()->put('string_movimentos', json_encode($string_movimentos));
    }
}
