<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('property_name')->nullable();
            $table->text('property_address')->nullable();
            $table->text('property_description')->nullable();
            $table->text('property_style')->nullable();
            $table->string('pet_allow')->nullable();
            $table->string('property_year_build')->nullable();
            $table->string('property_size')->nullable();
            $table->string('property_bedroom')->nullable();
            $table->string('property_bathroom')->nullable();
            $table->string('property_parking_type')->nullable();
            $table->string('property_air_con')->nullable();
            $table->string('monthly_fee')->nullable();
            $table->string('let_fee')->nullable();
            $table->string('deposit_fee')->nullable();
            $table->text('property_google_map');
            $table->integer('status');
            $table->integer('is_lease');
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
        Schema::dropIfExists('properties');
    }
}
