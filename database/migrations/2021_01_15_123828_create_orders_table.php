<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('vendor_id');
          $table->integer('user_id');
          $table->string('order_status');
          $table->decimal('total', 15, 2);
          $table->string('payment_fname');
          $table->string('payment_lname');
          $table->string('payment_address');
          $table->string('payment_zip');
          $table->string('payment_city');
          $table->string('payment_phone')->nullable();
          $table->string('payment_email');
          $table->string('payment_method');
          $table->string('payment_code')->nullable();
          $table->string('shipping_fname');
          $table->string('shipping_lname');
          $table->string('shipping_address');
          $table->string('shipping_zip');
          $table->string('shipping_city');
          $table->string('shipping_phone')->nullable();
          $table->string('shipping_email');
          $table->string('shipping_method');
          $table->string('shipping_code')->nullable();
          $table->text('comment')->nullable();
          $table->string('tracking_code')->nullable();
          $table->boolean('shipped')->default(false);
          $table->boolean('printed')->default(false);
          $table->timestamps();
        });

        Schema::create('order_products', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('order_id');
          $table->integer('product_id');
          $table->string('name');
          $table->integer('quantity')->unsigned();
          $table->decimal('price', 15, 2)->default(0);
          $table->decimal('discount', 15, 2)->default(0);
          $table->decimal('total', 15, 2)->default(0);
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
        Schema::dropIfExists('orders');
    }
}
