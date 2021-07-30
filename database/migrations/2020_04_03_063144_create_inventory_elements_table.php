<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'inventory_id' );
            $table->unsignedBigInteger( 'sku_id' );
            $table->string( 'readSku', 50 );
            $table->string( 'readProductName', 150 );
            $table->unsignedInteger( 'warehouse' )->default(1);
            $table->string( 'warehouseName', 30 )->default('ALSAFIX Romania');
            $table->integer( 'realStock' )->default(0);
            $table->integer( 'availableStock' )->default(0);
            $table->integer( 'reservedStock' )->default(0);
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
        Schema::dropIfExists('inventory_elements');
    }
}
