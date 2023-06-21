<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateAdminTable extends Migration
{
public function up()
{
    Schema::create('admin', function (Blueprint $table) {
        $table->id('admin_id');
        $table->string('nom_admin')->nullable();
        $table->string('email_admin')->nullable();
        $table->string('telephone_medecin')->nullable();
        $table->string('addresse_medecin')->nullable();
        $table->timestamps();

        $table->unsignedBigInteger('room_id');

        $table->unsignedBigInteger('id_agenda');

        $table->unsignedBigInteger('teleconsultation_id');

        $table->foreign('teleconsultation_id')
            ->references('id_teleconsultation')
            ->on('Teleconsultations')
            ->onDelete('cascade');

        $table->unsignedBigInteger('id_patient');

        $table->foreign('id_patient')
            ->references('IPP')
            ->on('patients')
            ->onDelete('cascade');
    });
}

}