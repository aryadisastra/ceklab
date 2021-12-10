<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPerawatAndTlm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_lab', function (Blueprint $table) {
            $table->char('perawat');
            $table->char('tlm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_lab', function (Blueprint $table) {
            $table->dropColumn('perawat');
            $table->dropColumn('tlm');
        });
    }
}
