<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrxGiftVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_gift_vouchers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->integer('voucher_id');
			$table->integer('sender_id');
			$table->string('method');
			$table->string('recipient');
			$table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_gift_vouchers');
    }
}
