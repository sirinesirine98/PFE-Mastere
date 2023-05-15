<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
{
    Schema::create('room', function (Blueprint $table) {
        $table->string('id_room')->primary();
        $table->string('code_room')->nullable();
        $table->string('id_teleconsultation')->nullable();//to add relationship
        $table->string('matricule_medecin')->nullable();//to add relationship
        $table->string('consultation_id')->nullable();//to add relationship
        $table->string('IPPP')->nullable();//to add relationship
        $table->foreign('id_teleconsultation')->references('id_teleconsultation')->on('Teleconsultations')->onDelete('cascade');
   
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
        Schema::dropIfExists('room');
    }
}
