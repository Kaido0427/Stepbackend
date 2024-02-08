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
        Schema::table('parking_space', function (Blueprint $table) {
            $table->integer('price_by_week')->nullable();
            $table->integer('price_by_month')->nullable();
        });
         
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parking_space', function (Blueprint $table) {
            $table->dropColumn('price_by_week');
            $table->dropColumn('price_by_month');
        });
    }
};
