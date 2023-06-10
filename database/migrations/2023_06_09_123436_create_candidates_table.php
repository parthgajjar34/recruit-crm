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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 40);
            $table->string('last_name', 40)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('contact_number', 100)->nullable();
            $table->tinyInteger('gender')->comment('Male - 1, Female - 2')->nullable();
            $table->string('specialization', 200)->nullable();
            $table->tinyInteger('work_ex_year')->nullable(); 
            $table->integer('candidate_dob')->nullable();
            $table->string('address', 500)->nullable();
            $table->string('resume')->nullable();
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
        Schema::dropIfExists('candidates');
    }
};
