<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Applications extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id');
            $table->foreignId('job_id')->constrained('jobs', 'job_id')->cascadeOnDelete();
            $table->unsignedBigInteger('employee_id');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('cover_letter')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
}

