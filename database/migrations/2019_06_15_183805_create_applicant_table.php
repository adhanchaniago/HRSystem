<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant', function (Blueprint $table) {
            $table->string('applicant_id', 7)->primary();
            $table->string('job_id',7)->nullable(true);
            $table->string('user_id',7)->nullable(true);
            $table->string('recruiter_id',7)->nullable(true);
            $table->date('applied_date');
            $table->string('current_step',20);
            $table->string('status',20);
            $table->timestamps();

            $table->foreign('job_id')
                ->references('job_id')
                ->on('job')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('recruiter_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant');
    }
}
