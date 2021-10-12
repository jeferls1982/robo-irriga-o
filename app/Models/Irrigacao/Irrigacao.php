<?php

namespace App\Models\Irrigacao;

use Illuminate\Database\Eloquent\Model;

class Irrigacao extends Model
{
    protected $table = 'irrigacao';

    protected $fillable = ['array_selecionados', 'horta_id','caminho'];

    public function horta(){
        return $this->belongsTo(Horta::class);
    }


}
