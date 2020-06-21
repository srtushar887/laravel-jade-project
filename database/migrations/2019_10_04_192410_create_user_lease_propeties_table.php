<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLeasePropetiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_lease_propeties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->string('assign_name')->nullable();
            $table->integer('assign_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('trems')->nullable();
            $table->string('start_date')->nullable();
            $table->string('last_date')->nullable();
            $table->text('lease_note')->nullable();
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
        Schema::dropIfExists('user_lease_propeties');
    }
}
