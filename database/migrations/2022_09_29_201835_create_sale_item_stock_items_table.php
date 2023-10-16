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
        Schema::create('sale_item_stock_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sale_item_id");
            $table->unsignedBigInteger("stock_item_id");
            $table->decimal("quantity", 17, 2);
            $table->json("stock_item_snapshot")->nullable();
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
        Schema::dropIfExists('sale_item_stock_items');
    }
};
