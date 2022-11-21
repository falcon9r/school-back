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
        Schema::create('days_in_schools', function (Blueprint $table) {
            $table->id();
            $table->integer('quarter_id');
            $table->integer('grade_id');
            $table->date('date');
            $table->integer('days_in_school_status_id');
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
        Schema::dropIfExists('days_in_schools');
    }
};
