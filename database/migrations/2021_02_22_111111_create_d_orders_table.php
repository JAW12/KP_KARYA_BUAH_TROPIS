<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('h_orders');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('jumlah');
            $table->integer('harga_jual');
            $table->integer('subtotal');
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
        Schema::dropIfExists('d_orders');
    }
}
