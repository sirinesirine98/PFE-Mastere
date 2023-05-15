<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichierPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('FichierPatient', function (Blueprint $table) {
            $table->string('id_fichier_patient')->primary();
            $table->date('date_creation_fichier')->nullable();
            $table->string('IPPP')->nullable();//to add relationship

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
        Schema::dropIfExists('fichier_patient');
    }
}
