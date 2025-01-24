<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jobs extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id('job_id');
            $table->string('title', 255);
            $table->text('description');
            $table->string('location', 255)->nullable();
            $table->string('category', 100);
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('status', ['open', 'closed', 'in progress'])->default('open');
            $table->unsignedBigInteger('employer_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('employer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
