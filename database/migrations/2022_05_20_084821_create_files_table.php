<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('group')->nullable();
            $table->string('type');
            $table->string('name');
            $table->unsignedBigInteger('size');
            $table->string('public_id');
            $table->string('src');
            $table->timestamps();

            // Indexes
            $table->index(['organization_id']);

            // Foreign constraints
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
