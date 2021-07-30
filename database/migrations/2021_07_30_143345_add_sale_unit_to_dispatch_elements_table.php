<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleUnitToDispatchElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispatch_elements', function (Blueprint $table) {
            $table->foreignId('sale_unit_id')
                  ->default(1)
                  ->after('price');
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
            $table->dropColumn('sale_unit_id');
        });
    }
}
