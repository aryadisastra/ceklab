<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDataLab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_lab', function (Blueprint $table) {
            $table->string('kode_lab');
            $table->integer('id_pasien');
            $table->char('dokter');
            $table->text('hasil_lab')->nullable(True);
            $table->text('bukti_lab')->nullable(True);
            $table->text('status');
            $table->char('creator');
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
        Schema::dropIfExists('data_lab');
    }
}
