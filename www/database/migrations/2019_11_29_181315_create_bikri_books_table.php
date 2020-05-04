<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikriBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bikri_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('provider_id');
            $table->string('kham_bikri');
            $table->bigInteger('comission')->default(7);

            $table->bigInteger('minhai')->default(0);
            $table->bigInteger('mazdori')->default(0);
            $table->bigInteger('karaya')->default(0);
            $table->bigInteger('daak')->default(0);
            $table->bigInteger('store')->default(0);

            $table->string('safi_bikri')->nullable();
            $table->string('description')->nullable();

            $table->boolean('is_paid')->default(false);

            $table->foreign('provider_id')->references('id')->on('providers')->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('bikri_books');
    }
}
