<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichierPatientTeleconsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichier_patient_teleconsultation', function (Blueprint $table) {
       $table->string('id_fichier_patient')->primary();
            $table->date('date_creation_fichier')->nullable();
            $table->string('IPPP')->nullable();//to add relationship

            $table->timestamps();
           $table->unsignedBigInteger('id_admin');

        $table->foreign('id_admin')
            ->references('admin_id')
            ->on('admin')
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
        Schema::dropIfExists('fichier_patient_teleconsultation');
    }
}
