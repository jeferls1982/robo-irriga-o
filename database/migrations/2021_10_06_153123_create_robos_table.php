<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRobosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robos', function (Blueprint $table) {
            $table->id();
            $table->integer('x');
            $table->integer('y');
            $table->integer('proxX')->nullable();
            $table->integer('proxY')->nullable();
            $table->string('orientacao');

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
        Schema::dropIfExists('robos');
    }
}
