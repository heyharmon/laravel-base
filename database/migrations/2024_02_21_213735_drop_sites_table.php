<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sites');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id');
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('domain')->unique();
            $table->string('scheme');
            $table->json('launch_info')->nullable();
            $table->timestamps();

            // Indexes
            $table->index(['organization_id']);

            // Foreign constraints
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }
};
