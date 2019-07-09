<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview', function (Blueprint $table) {
            $table->string('interview_id', 7)->primary();
            $table->string('interview_type_id', 7)->nullable(true);
            $table->string('interviewer_id', 7)->nullable(true);
            $table->string('applicant_id', 7)->nullable(true);
            $table->string('interview_venue', 500)->nullable(true);
            $table->string('interview_code', 11)->nullable(true);
            $table->integer('interview_score')->nullable(true);
            $table->datetime('interview_date')->nullable(true);
            $table->datetime('interview_time')->nullable(true);
            $table->string('status', 10)->nullable(true);
            $table->timestamps();

            $table->foreign('interviewer_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');

            $table->foreign('applicant_id')
                ->references('applicant_id')
                ->on('applicant')
                ->onDelete('cascade');

            $table->foreign('interview_type_id')
                ->references('interview_type_id')
                ->on('interview_type')
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
        Schema::dropIfExists('interview');
    }
}
