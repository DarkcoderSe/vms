<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('temp_book_id');
            $table->unsignedBigInteger('food_type_id');

            $table->bigInteger('quantity')->default(0);
            $table->string('sub_total');

            $table->foreign('temp_book_id')->references('id')->on('temp_books')->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('food_type_id')->references('id')->on('food_types')->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('carts');
    }
}
