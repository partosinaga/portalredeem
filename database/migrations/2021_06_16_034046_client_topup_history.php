<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientTopupHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_topup_history', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->integer('client_id');
			$table->integer('trx_id');
			$table->string('amount');
			$table->string('deposit_amount_before');
			$table->string('deposit_amount_after');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_topup_history');
    }
}
