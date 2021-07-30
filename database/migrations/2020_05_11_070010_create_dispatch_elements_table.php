<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatch_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'dispatch_id' );
            $table->string( 'sku', 50 )->default( '' )->index();
            $table->char( 'ean', 13 )->default('')->index();
            $table->unsignedInteger( 'unit' )->default(1);
            $table->text( 'productName' )->nullable();
            $table->Integer( 'qtyOrdered' );
            $table->Integer( 'qtyDelivered' );
            $table->Integer( 'qtyRemaining' );
            $table->Integer( 'qty' )->default(1);
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
        Schema::dropIfExists('dispatch_elements');
    }
}
