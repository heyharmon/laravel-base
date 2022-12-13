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
        Schema::table('pages', function (Blueprint $table) {
            // Make column nullable
            $table->string('requested_url')->nullable(true)->change();

            // Drop column
            $table->dropColumn('redirected');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            // Remove nullable
            $table->string('requested_url')->nullable(false)->change();

            // Add column
            $table->boolean('redirected')->default(0)->after('wordcount');
        });
    }
};
