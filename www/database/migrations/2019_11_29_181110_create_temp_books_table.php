<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('customer_id');

            // $table->unsignedBigInteger('trade_mark_id');
            // $table->unsignedBigInteger('food_type_id');

            //autofill
            // $table->bigInteger('price_per_crate')->default(0);
            
            $table->bigInteger('total_price')->default(0);
            $table->bigInteger('paid_ammount')->default(0);
            $table->bigInteger('due_ammount')->default(0);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade")->onUpdate("cascade");
            // $table->foreign('trade_mark_id', 'tmfk2')->references('id')->on('trade_marks');
            // $table->foreign('food_type_id')->references('id')->on('food_types');

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
        Schema::dropIfExists('temp_books');
    }
}
