<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('patients', function (Blueprint $table) {
        $table->id('IPP');
        $table->string('nomdenaissance')->nullable();
        $table->string('prenom')->nullable();
        $table->date('datedenaissance')->nullable();
        $table->string('ville')->nullable();
        $table->string('email')->nullable();
        $table->string('telephone')->nullable();
        $table->string('numdossier')->nullable();
        $table->string('actions')->nullable();
        $table->unsignedBigInteger('doctor_id')->nullable();
        $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
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
        Schema::dropIfExists('patients');
    }
}
