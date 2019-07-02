<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->string('message_id', 7)->primary();
            $table->string('subject', 50)->nullable(true);
            $table->string('body', 500);
            $table->string('from', 7)->nullable(true);
            $table->string('to', 7)->nullable(true);
            $table->timestamps();

            $table->foreign('from')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('to')
                ->references('user_id')
                ->on('users')
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
        Schema::dropIfExists('message');
    }
}
