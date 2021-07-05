<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->foreign()->references('id')->on('users')->onDelete('cascade');
            $table->boolean('type')->comment('1 => "Current Address" || 0 => "Permanent Address"');
            $table->string('line_one');
            $table->string('line_two')->nullable();
            $table->integer('city_id')->foreign()->references('id')->on('cities');
            $table->integer('state_id')->foreign()->references('id')->on('states');
            $table->integer('country_id')->foreign()->references('id')->on('countries');
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
        Schema::dropIfExists('addresses');
    }
}
