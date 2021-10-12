<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrrigacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irrigacao', function (Blueprint $table) {
            $table->id();
            $table->longText('array_selecionados')->nullable();
            $table->longText('caminho')->nullable();


            $table->unsignedBigInteger('horta_id');

            $table->foreign('horta_id')
                ->references('id')
                ->on('hortas')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irrigacaos');
    }
}
