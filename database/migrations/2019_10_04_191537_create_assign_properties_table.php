<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('property_id')->nullable();
            $table->integer('tanants_id')->nullable();
            $table->string('assign_name')->nullable();
            $table->string('trems')->nullable();
            $table->string('start_date')->nullable();
            $table->string('last_date')->nullable();
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
        Schema::dropIfExists('assign_properties');
    }
}
