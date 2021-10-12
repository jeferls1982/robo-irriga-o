<?php

namespace App\Models\Irrigacao;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class Robo extends Model
{
    protected $fillable = ['x', 'y', 'proxX', 'proxY', 'orientacao', 'horta_id'];

    public function horta()
    {
        return $this->belongsTo(Horta::class);
    }


    public static function getOrientacao($o)
    {
        switch ($o) {
            case 's':
                return 'Sul \/';
                break;
            case 'o':
                return '< Oeste';
                break;
            case 'l':
                return 'Leste >';
                break;
            case 'n':
                return "/\ Norte";
                break;
        }
        return;
    }
}
