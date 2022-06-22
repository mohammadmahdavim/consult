<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('caller')->nullable();
            $table->foreign('caller')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
            $table->unsignedBigInteger('consult_id');
            $table->foreign('consult_id')->references('id')->on('consults')->onDelete('cascade');
            $table->unsignedBigInteger('paye_id');
            $table->foreign('paye_id')->references('id')->on('payes')->onDelete('cascade');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('city_id');
            $table->string('mobile')->nullable();
            $table->string('mobile2')->nullable();
            $table->tinyInteger('kanoon')->default(0);
            $table->integer('counter')->nullable();
            $table->string('description');
            $table->string('status')->default('create');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('service_student', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_id')->unsigned();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedBigInteger('consult_id');
            $table->foreign('consult_id')->references('id')->on('consults')->onDelete('cascade');
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
//            $table->primary(['service_id', 'student_id','consult_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
