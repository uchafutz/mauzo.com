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
        Schema::create('inventory_stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->string("source_id");
            $table->string("source_type");
            $table->string("destination_id");
            $table->string("destination_type");
            $table->unsignedBigInteger("inv_item_id");
            $table->float("quantity");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_stock_transactions');
    }
};
