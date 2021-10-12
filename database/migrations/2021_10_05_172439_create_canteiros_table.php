<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanteirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canteiros', function (Blueprint $table) {
            $table->id();
            $table->integer('x');
            $table->integer('y');
            $table->boolean('active',false);
            $table->boolean('caminho',false);
            $table->boolean('irrigado', false);
            $table->boolean('inicio_robo', false);

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
        Schema::dropIfExists('canteiros');
    }
}
