<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Consultations', function (Blueprint $table) {
            $table->id('id_consultation');
            $table->date('date_consultation')->nullable();
            $table->time('heure_consultation')->nullable();
  $table->unsignedBigInteger('teleconsultation_id');

        $table->foreign('teleconsultation_id')
            ->references('id_teleconsultation')
            ->on('Teleconsultations')
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
        Schema::dropIfExists('consultations');
    }
}
