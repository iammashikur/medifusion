<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('birth_date');
            $table->string('gender');
            $table->string('avatar')->nullable();
            $table->string('zilla')->nullable();
            $table->string('upazilla')->nullable();
            $table->string('phone');
            $table->string('blood_group')->nullable();
            $table->string('notification_id')->nullable();
            $table->string('password')->nullable();
            $table->integer('referred_by_id')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
