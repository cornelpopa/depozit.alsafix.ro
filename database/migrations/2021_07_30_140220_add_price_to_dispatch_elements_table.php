<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToDispatchElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatch_elements', function (Blueprint $table) {
            $table->float('price', 8, 2)
                  ->after('qty')
                  ->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dispatch_elements', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
