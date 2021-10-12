<?php

namespace App\Models\Irrigacao;

use Illuminate\Database\Eloquent\Model;

class Canteiro extends Model
{
    protected $fillable = ['x', 'y', 'horta_id', 'active', 'caminho', 'irrigado', 'inicio_robo'];

    public function horta()
    {
        return $this->belongsTo(Horta::class);
    }

    public static function clearActives($id)
    {
        $canteiros = Canteiro::where('horta_id', $id)
                            ->get();
        foreach ($canteiros as $canteiro) {
            $canteiro->update([
                'active' => false,
                'inicio_robo' => false,
                'caminho' => false,
                'irrigado' => false
            ]);
        }
        return;
    }
}
