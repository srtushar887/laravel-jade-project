<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tanant_id')->nullable();
            $table->string('paymentid')->nullable();
            $table->string('trackid')->nullable();
            $table->string('Error')->nullable();
            $table->string('result')->nullable();
            $table->string('postdate')->nullable();
            $table->string('tranid')->nullable();
            $table->string('auth')->nullable();
            $table->string('avr')->nullable();
            $table->string('ref')->nullable();
            $table->string('amt')->nullable();
            $table->string('udf1')->nullable();
            $table->string('udf2')->nullable();
            $table->string('udf3')->nullable();
            $table->string('udf5')->nullable();
            $table->integer('status')->nullable();

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
        Schema::dropIfExists('deposits');
    }
}
