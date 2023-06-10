<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeurRdvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('demandeur_rdv', function (Blueprint $table) {
        $table->id('demandeur_id');
        $table->string('name_user')->nullable();
        $table->string('email_user')->nullable();
        $table->string('telephone_user')->nullable();
        $table->string('nom_medecin')->nullable();
        $table->date('date_rdv')->nullable();
        $table->time('heure_rdv')->nullable();
        $table->string('message')->nullable();
        $table->string('etat')->nullable();
        $table->unsignedBigInteger('rdv_id')->nullable();
        $table->foreign('rdv_id')->references('id')->on('appointments')->onDelete('cascade');
     
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
        Schema::dropIfExists('demandeur_rdv');
    }
}
