<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeleconsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('Teleconsultations', function (Blueprint $table) {
        $table->id('id_teleconsultation');
        $table->date('date_teleconsultation')->nullable();
        $table->time('heure_teleconsultation')->nullable();
        $table->string('prenom_patient')->nullable();
        $table->unsignedBigInteger('admin_id');
        $table->timestamps();
        
      
      //  $table->foreign('admin_id')->references('admin_id')->on('admin')->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('teleconsultations');
    }
}
