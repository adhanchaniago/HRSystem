<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document', function (Blueprint $table) {
            $table->string('document_id', 7)->primary();
            $table->string('regarding_id',7)->nullable(true);
            $table->string('document_name',100);
            $table->string('document_type_id',7)->nullable(true);
            $table->string('document_url',200);

            $table->timestamps();

            $table->foreign('regarding_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('regarding_id')
                ->references('applicant_id')
                ->on('applicant')
                ->onDelete('cascade');

            $table->foreign('regarding_id')
                ->references('application_progress_id')
                ->on('application_progress')
                ->onDelete('cascade');

            $table->foreign('regarding_id')
                ->references('message_id')
                ->on('message')
                ->onDelete('cascade');

            $table->foreign('document_type_id')
                ->references('document_type_id')
                ->on('document_type')
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
        Schema::dropIfExists('document');
    }
}
