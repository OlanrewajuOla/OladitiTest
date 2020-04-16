<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->bigIncrements('lecturers_id');
            $table->string('fullname');
            $table->string('Email')->unique();
            $table->string('department');
            $table->string('gender');
            $table->string('dateofbirth');
            $table->string('Address');
            $table->string('Qualification');
            $table->string('Experience');
            $table->string('cader');
            $table->string('Expectedworkload');
            $table->string('AreaofInterest');
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
        Schema::dropIfExists('lecturers');
    }
}
