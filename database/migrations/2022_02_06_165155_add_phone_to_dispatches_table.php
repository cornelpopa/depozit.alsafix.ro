<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToDispatchesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatches', function (Blueprint $table) {
            $table->string('phone', 20)
                  ->after('gescomReferenceOrder')
                  ->nullable()
                  ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dispatches', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
}
