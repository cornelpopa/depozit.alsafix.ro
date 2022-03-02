<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForwardersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forwarders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('scan_length');
            $table->string('barcode')->nullable()->default('');
            $table->string('limits')->nullable()->default('');
            $table->string('tracking_website')->nullable()->default('');
            $table->boolean('is_active')
                  ->default(true);
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
        Schema::dropIfExists('forwarders');
    }
}
