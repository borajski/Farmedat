<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('user_id');
          $table->unsignedInteger('plan_id');
          $table->string('name');
          $table->string('address')->nullable();
          $table->string('zip')->nullable();
          $table->string('city')->nullable();
          $table->string('oib')->nullable();
          $table->string('phone')->nullable();
          $table->string('email')->nullable();
          $table->string('www')->nullable();
          $table->string('logo')->default('images/users/default-logo.png');
          $table->string('cover')->default('images/users/default-cover.png');
          $table->longText('description')->nullable();
          $table->longText('interes')->nullable();
          $table->string('longitude')->nullable();
          $table->string('latitude')->nullable();
          $table->string('live')->default('ne');
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
        Schema::dropIfExists('vendors');
    }
}
