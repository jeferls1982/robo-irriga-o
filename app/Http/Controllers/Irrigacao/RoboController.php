<?php

namespace App\Http\Controllers\Irrigacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Irrigacao\Robo;
use App\Models\Irrigacao\Canteiro;
use stdClass;
use Illuminate\Support\Facades\Session;
use App\Models\Irrigacao\Horta;

class RoboController extends Controller
{
    private $robo;
    private $canteiro;

    public function __construct(Robo $robo, Canteiro $canteiro)
    {
        $this->robo = $robo;
        $this->canteiro = $canteiro;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        // valido se o form vem
        if ($request['posicao_robo'] == null && $request['x'] == null && $request['y'] == null) {
            Session::flash('message', "Informe a posição do robo!");
            return back();
        }
        $robo = null;
        if($this->robo->where('horta_id', $request['horta_id'])->get()){
            $robo = $this->robo->where('horta_id', $request['horta_id'])->first();
        }

        if ($request['radio'] == "true") {
            $posicao = $this->canteiro->find($request->posicao_robo);
        } else {
            $posicao = new stdClass();
            $posicao->x = $request['x'];
            $posicao->y = $request['y'];
        };

        if($robo){
            $this->canteiro->clearActives($request['horta_id']);
            $robo->update(['x'=> $posicao->x, 'y'=>$posicao->y]);
            return redirect('/irrigacao/'.$request['horta_id']);
        }

        $this->robo->horta_id = $request['horta_id'];
        $this->robo->x = $posicao->x;
        $this->robo->y = $posicao->y;
        $this->robo->orientacao = $request['orientacao'];



        $canteiro = Canteiro::with('horta')
                ->where('x', $this->robo->x)
                ->where('y',$this->robo->y)
                ->where('horta_id',$this->robo->horta_id)
                ->first();
        $canteiro->update(['inicio_robo' => true]);


        $this->robo->save();

        return redirect('/irrigacao/'.$this->robo->horta_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horta = session()->get($id);
        return view('irrigacao.pages.robo.create', compact('horta'));
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
}
