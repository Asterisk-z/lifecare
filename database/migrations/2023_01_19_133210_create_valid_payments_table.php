<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valid_payments', function (Blueprint $table) {
            $table->id();
            $table->string('tx_ref')->nullable();
            $table->string('flw_ref')->nullable();
            $table->string('device_fingerprint')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('charged_amount')->nullable();
            $table->string('app_fee')->nullable();
            $table->string('merchant_fee')->nullable();
            $table->string('processor_response')->nullable();
            $table->string('auth_model')->nullable();
            $table->string('ip')->nullable();
            $table->string('narration')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('created_at')->nullable();
            $table->string('account_id')->nullable();
            $table->text('card')->nullable();
            $table->text('meta')->nullable();
            $table->string('amount_settled')->nullable();
            $table->text('customer')->nullable();
            $table->timestamp('updated_at')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('valid_payments');
    }
}
