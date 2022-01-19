<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedInteger('vendor_id')->index();
          $table->string('name')->index();
          $table->text('description')->nullable();
          $table->text('category')->nullable();
          $table->text('subcategory')->nullable();
          $table->string('sku', 14)->default(0)->index();
          $table->decimal('price', 15, 2)->default(0);
          $table->integer('quantity')->unsigned()->default(0);
          $table->string('measure_unit')->nullable();
          $table->string('delivery_type')->nullable();
          $table->integer('min_order')->nullable();
          $table->decimal('delivery_price', 15, 4)->default(0);
          $table->string('delivery_include')->default('Ne');
          $table->string('image')->nullable();
          $table->string('live')->default('ne');
            $table->timestamps();
        });
     Schema::create('product_images', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->integer('product_id')->unsigned()->index();
        $table->string('image')->nullable();
        $table->string('alt')->nullable();
        $table->timestamps();
    });
    Schema::create('product_actions', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('product_id')->unsigned()->index();
          $table->integer('affiliate_id')->unsigned()->nullable();
          $table->string('name')->nullable();
          $table->decimal('price', 15, 4)->nullable();
          $table->integer('discount')->unsigned()->nullable();
          $table->DateTime('date_start')->nullable();
          $table->DateTime('date_end')->nullable();
          $table->string('coupon')->nullable();
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
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_actions');
    }
}
