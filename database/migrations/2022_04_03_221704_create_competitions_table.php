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

        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('logo');
            $table->string('description');
            $table->boolean('status')->default(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->date('date_reg_start_first_batch');
            $table->date('date_reg_end_first_batch');
            $table->bigInteger('price_first_batch');
            $table->date('date_reg_start_second_batch');
            $table->date('date_reg_end_second_batch');
            $table->bigInteger('price_second_batch');
            $table->bigInteger('prize_pool');
            $table->bigInteger('max_member');
            $table->string('guide_file');
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
        Schema::dropIfExists('competitions');
    }
};
