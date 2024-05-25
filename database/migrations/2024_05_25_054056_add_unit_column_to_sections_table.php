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
        Schema::table('sections', function (Blueprint $table) {
            $table->integer('start_unit')->nullable()->after('order');
            $table->integer('start_paragraph')->nullable()->after('order');
            $table->integer('end_unit')->nullable()->after('order');
            $table->integer('end_paragraph')->nullable()->after('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn(['start_unit', 'end_unit', 'start_paragraph', 'end_paragraph']);
        });
    }
};
