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
        Schema::table('crawls', function (Blueprint $table) {
            // Add new columns
            $table->foreignId('organization_id')->after('id');

            // Add Foreign constraints
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
        Schema::table('crawls', function (Blueprint $table) {
            // Drop Columns
            $table->dropColumn('organization_id');

            // Drop foreign constraints
            $table->dropForeign('crawls_organization_id_foreign');
        });
    }
};
