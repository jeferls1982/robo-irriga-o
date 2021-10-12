<?php

namespace App\Models\Irrigacao;

use Illuminate\Database\Eloquent\Model;
use App\Models\Irrigacao\Canteiro;
use stdClass;

class Horta extends Model
{
    protected $fillable = ['nome','linhas', 'colunas'];

    public function canteiros(){
        return $this->hasMany(Canteiro::class);
    }

    public function robo(){
        return $this->hasOne(Robo::class);
    }

    public function irrigacoes(){
        return $this->hasMany(Irrigacao::class);
    }


    public function storeCanteiros($horta){
        for($y = $horta->linhas -1 ; $y >= 0; $y--){
            for($x = 0; $x < $horta->colunas ; $x++){

                $canteiro = [];
                $canteiro['horta_id'] = $horta->id;
                $canteiro['x'] = $x;
                $canteiro['y'] = $y;
                $canteiro['active'] = false;
                $canteiro['caminho'] = false;
                $canteiro['irrigado'] = false;
                $canteiro['inicio_robo'] = false;

                Canteiro::create($canteiro);
            }
        }
        return;
    }

    public function getMax($horta){
        $max = new stdClass();
        $max->x = $horta->canteiros->max('x');
        $max->y = $horta->canteiros->max('y');
        return $max;

    }

}
