<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('trade_mark_id');
            $table->string('serial_no');
            $table->bigInteger('total_quantity')->default(0);
            $table->bigInteger('remaining_quantity')->default(0);
            $table->bigInteger('price_per_crate')->default(0);

            $table->foreign('trade_mark_id', 'tmfk')->references('id')->on('trade_marks')->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('food_types');
    }
}
