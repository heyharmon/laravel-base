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
            $table->string('status')->default('READY')->change();
            $table->integer('total')->default(0)->after('status');
            $table->integer('handled')->default(0)->after('total');
            $table->integer('pending')->default(0)->after('handled');
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
            $table->dropColumn('total');
            $table->dropColumn('handled');
            $table->dropColumn('pending');
        });
    }
};
