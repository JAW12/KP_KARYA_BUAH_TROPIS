<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('h_requests')->onDelete('cascade');
            $table->foreignId('fruit_id')->constrained('fruits');
            $table->integer('jumlah');
            $table->integer('status');
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
        Schema::dropIfExists('d_requests');
    }
}
