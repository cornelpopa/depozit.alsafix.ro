<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' );
            $table->string( 'name', 30 );
            $table->text( 'observation' )->default('');
            $table->timestamp( 'inventoryDate' )->useCurrent();
            $table->timestamps();

            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'restrict' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
