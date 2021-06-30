<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('Phone');
            $table->decimal('Price');
            $table->text('Address');
            $table->foreignId('State_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreignId('Counter_id')->references('id')->on('counters')->onDelete('cascade');
            $table->foreignId('Box_id')->references('id')->on('boxes')->onDelete('cascade');
            $table->tinyInteger('Status');
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
        Schema::dropIfExists('customers');
    }
}
