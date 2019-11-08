<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->string('surname')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('email')->nullable(false);
            $table->bigInteger('developer_type')->nullable(false);
            $table->bigInteger('developer_skill')->nullable(false);
            $table->string('linked_in_profile')->nullable(false);
            $table->string('github_profile')->nullable(false);
            $table->jsonb('files')->nullable(false);
            $table->unsignedBigInteger('submission_type')->nullable(false);
            $table->timestamps();
            $table->foreign('submission_type')->references('id')->on('user_types')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
