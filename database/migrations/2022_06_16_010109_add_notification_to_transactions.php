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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('settlement_time')->nullable()->after('pdf_url');
            $table->json('notification')->nullable()->after('response');
            $table->string('registration_batch')->nullable()->after('notification');
            $table->bigInteger('registration_price')->nullable()->after('registration_batch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['settlement_time', 'notification', 'registration_batch', 'registration_price']);
        });
    }
};
