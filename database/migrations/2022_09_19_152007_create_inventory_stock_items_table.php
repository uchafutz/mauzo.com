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
        Schema::create('inventory_stock_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("inv_item_id");
            $table->unsignedBigInteger("source_id");
            $table->string("source_type");
            $table->unsignedBigInteger("inv_warehouse_id");
            $table->float("quantity");
            $table->decimal("unit_cost",17,2);
            $table->float("in_stock");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_stock_items');
    }
};
