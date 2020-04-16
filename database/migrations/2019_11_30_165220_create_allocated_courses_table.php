<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllocatedCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocated_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lecturers_id');
            $table->string('course_id');
            $table->string('department');
            $table->string('level');
            $table->string('semester');
            $table->string('course_title');
            $table->string('course_code');
            $table->string('course_unit');
            $table->string('stream')->nullable();
            $table->string('externaldepartment')->nullable();
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
        Schema::dropIfExists('allocated_courses');
    }
}
