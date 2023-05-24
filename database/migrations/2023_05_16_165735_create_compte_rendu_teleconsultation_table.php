<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompteRenduTeleconsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('compte_rendu_teleconsultation', function (Blueprint $table) {
         $table->id('id_compterendu');
         $table->string('name')->nullable();
        $table->string('date')->nullable();
        $table->string('status')->nullable();
        $table->string('diagnostic')->nullable();
        $table->string('resultat')->nullable();
        $table->string('user_id')->nullable();
        $table->timestamps();
        $table->unsignedBigInteger('teleconsultation_id');

        $table->foreign('teleconsultation_id')
            ->references('id_teleconsultation')
            ->on('Teleconsultations')
            ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compte_rendu_teleconsultation');
    }
}
