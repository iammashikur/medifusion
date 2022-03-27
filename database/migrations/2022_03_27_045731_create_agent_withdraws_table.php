<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('amount');
            $table->integer('agent_id');
            $table->integer('status');
            $table->string('withdraw_method');
            $table->text('account_details');
            $table->text('trx_id')->nullable();
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
        Schema::dropIfExists('agent_withdraws');
    }
}
