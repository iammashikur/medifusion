<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone');
            $table->string('password');
            $table->text('billing_address')->nullable();
            $table->string('zilla')->nullable();
            $table->string('upazilla')->nullable();
            $table->string('bkash')->nullable();
            $table->string('nagad')->nullable();
            $table->integer('commission')->nullable();
            $table->string('notification_id')->nullable();
            $table->integer('status')->nullable();
            $table->text('bank_details')->nullable();
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
        Schema::dropIfExists('agents');
    }
}
