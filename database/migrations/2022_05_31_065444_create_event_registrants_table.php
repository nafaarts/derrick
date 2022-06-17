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

    // name
    //     Current Status
    //     - Active student
    //     - Fresh graduate
    //     - Young Professional (1-3 years work experience)
    //     - Practitioner with more than 3 years of work experience
    //     Level of Education
    //     - S1
    //     - S2
    //     - S3
    //     - D3/D4
    //     City of Resident
    //     Institution / University
    //     Major
    //     Phone Number
    //     Please write down any question regarding our upcoming event
    public function up()
    {
        Schema::create('event_registrants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events');
            $table->string('name');
            $table->string('email');
            $table->string('education_level');
            $table->string('current_status');
            $table->string('resident');
            $table->string('institution');
            $table->string('major');
            $table->string('phone');
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('event_registrants');
    }
};
