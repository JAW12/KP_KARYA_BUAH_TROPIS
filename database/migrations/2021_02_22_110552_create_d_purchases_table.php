<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('h_purchases')->onDelete('cascade');
            $table->foreignId('fruit_id')->constrained('fruits');
            $table->integer('jumlah');
            $table->integer('harga_beli');
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
        Schema::dropIfExists('d_purchases');
    }
}
