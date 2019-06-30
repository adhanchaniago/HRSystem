<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_skill', function (Blueprint $table) {
            $table->string('job_skill_id', 7)->primary();
            $table->string('job_id', 7)->nullable(true);
            $table->string('skill_name', 50);
            $table->integer('rate');
            $table->timestamps();

            $table->foreign('job_id')
                ->references('job_id')
                ->on('job')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_skill');
    }
}
