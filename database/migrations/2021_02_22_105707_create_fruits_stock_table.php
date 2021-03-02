<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFruitsStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fruits_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fruit_id')->constrained('fruits');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('berat');
            $table->integer('status');
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fruits_stock');
    }
}
