<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job', function (Blueprint $table) {

            $table->string('job_id', 7)->primary();
            $table->string('department_id', 7)->nullable(true);

            $table->string('job_name',50);
            $table->string('description',200);
            $table->integer('salary')->nullable(true);
            $table->integer('minimum_age')->nullable(true);
            $table->integer('minimum_experience')->nullable(true);
            $table->date('active_date');
            $table->date('expired_date');
            $table->string('status',50);
            $table->timestamps();

            $table->foreign('department_id')
                ->references('department_id')
                ->on('department')
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
        Schema::dropIfExists('job');
    }
}
