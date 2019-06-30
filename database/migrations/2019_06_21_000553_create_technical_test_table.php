<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnicalTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_test', function (Blueprint $table) {
            $table->string('technical_test_id', 7)->primary();
            $table->string('applicant_id', 7)->nullable(true);
            $table->integer('score_1')->nullable(true);
            $table->integer('score_2')->nullable(true);
            $table->integer('score_3')->nullable(true);
            $table->integer('score_4')->nullable(true);
            $table->integer('average_score')->nullable(true);
            $table->string('status')->nullable(true);
            $table->timestamps();

            $table->foreign('applicant_id')
                ->references('applicant_id')
                ->on('applicant')
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
        Schema::dropIfExists('technical_test');
    }
}
