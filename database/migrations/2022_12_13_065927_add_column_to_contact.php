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
        Schema::table('customers', function (Blueprint $table) {
            $table->String("bus_name")->nullable();
            $table->String("bus_address")->nullable();
            $table->String("bus_phone")->nullable();
            $table->String("bus_tin")->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn("bus_name");
            $table->dropColumn("bus_phone");
            $table->dropColumn("bus_address");
            $table->dropColumn("bus_tin");

            //
        });
    }
};