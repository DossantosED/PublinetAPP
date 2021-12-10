<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisplayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('company_id');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->enum('type',['indoor','outdoor']);
            $table->decimal('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('display');
    }
}
