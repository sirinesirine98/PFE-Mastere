<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichierCompterenduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichier_compterendu', function (Blueprint $table) {
            $table->string('id_compterendu')->primary();
            $table->date('date_creation')->nullable();
            $table->date('date_modification')->nullable();
            $table->string('format_cr')->nullable();
          
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
        Schema::dropIfExists('fichier_compterendu');
    }
}
