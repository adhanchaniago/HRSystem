<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_progress', function (Blueprint $table) {
            $table->string('application_progress_id', 7)->primary();
            $table->string('job_id', 7)->nullable(true);
            $table->string('progress_name', 50)->nullable(true);
            $table->string('attachment_url', 200)->nullable(true);
            $table->integer('sequence')->nullable(true);
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
        Schema::dropIfExists('application_progress');
    }
}
