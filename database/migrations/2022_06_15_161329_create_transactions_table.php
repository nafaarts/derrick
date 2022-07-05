<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registrant_id')->constrained('registrants')->onUpdate('cascade')->onDelete('cascade');
            $table->string('merchant_order_id');
            $table->string('reference');
            $table->string('status_code');
            $table->string('status_message');
            $table->string('amount');
            $table->string('fee');
            $table->string('payment_code')->nullable();
            $table->string('result_code')->nullable();
            $table->json('response')->nullable();
            $table->json('notification')->nullable();
            $table->string('registration_batch')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
