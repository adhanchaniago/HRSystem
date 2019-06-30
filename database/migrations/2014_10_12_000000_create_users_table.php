<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id', 7)->primary();
            $table->string('department_id', 7)->nullable(true);

            $table->string('first_name',20);
            $table->string('last_name', 20);

            $table->string('email', 50)->unique();
            $table->string('password',100);

            $table->date('birth_date')->nullable(true);
            $table->string('birth_place', 20)->nullable(true);

            $table->string('gender', 10)->nullable(true);

            $table->string('phone', 15)->nullable(true);
            $table->string('address', 50)->nullable(true);

            $table->string('university', 100)->nullable(true);
            $table->string('major', 50)->nullable(true);
            $table->string('degree', 51)->nullable(true);

            $table->string('role_id', 7)->nullable(true);
            $table->string('photo_url', 200)->nullable(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('department_id')
                ->references('department_id')
                ->on('department')
                ->onDelete('set null');

            $table->foreign('role_id')
                ->references('role_id')
                ->on('role')
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
        Schema::dropIfExists('users');
    }
}
