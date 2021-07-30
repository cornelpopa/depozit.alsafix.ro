<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceptionElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reception_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'reception_id' );
            $table->unsignedInteger( 'qty' )->default(1);
            $table->unsignedInteger( 'unit' )->default(1);
            $table->string( 'sku', 50 )->default('')->index();
            $table->char( 'ean', 13 )->default('')->index();
            $table->text( 'productName' )->nullable();
            $table->timestamps();

            $table->index( 'reception_id', 'ean' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reception_elements');
    }
}
