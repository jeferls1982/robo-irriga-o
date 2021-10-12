<?php

namespace App\Http\Controllers\Irrigacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPUnit\Runner\Hook;
use stdClass;
use App\Models\Irrigacao\Horta;
use App\Models\Irrigacao\Canteiro;

use function Symfony\Component\String\b;

class HortaController extends Controller
{
    private $horta;
    private $canteiro;
    public function __construct(Horta $horta, Canteiro $canteiro)
    {
        $this->horta  = $horta;
        $this->canteiro = $canteiro;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hortas = $this->horta->get();
        return view('irrigacao.pages.horta.list', compact('hortas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('irrigacao.pages.horta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request['nome'] == null || $request['linhas'] == null || $request['colunas'] == null) {
            Session::flash('message', "Por favor, preencha todos os campos.");
            return back();
        }
        $horta = $this->horta->create($request->all());
        $horta->storeCanteiros($horta);
        return redirect('/horta/' . $horta->id)->with('msg', "Horta Registrada!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $horta = $this->horta->with('canteiros')->find($id);
        $max = $horta->getMax($horta);
        return view('irrigacao.pages.horta.show', compact('horta', 'max'));
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

    }
}
