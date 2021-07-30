<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'user_id' )->index();
            $table->unsignedBigInteger( 'name')->index();
            $table->date( 'dispatchDate' );
            $table->unsignedBigInteger( 'gescomCodeClient' )->index();
            $table->string( 'gescomClientName');
            $table->string( 'gescomCity' );
            $table->unsignedBigInteger( 'agent_id' )->index();
            $table->string( 'gescomReferenceOrder', 30);


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
        Schema::dropIfExists('dispatches');
    }
}
