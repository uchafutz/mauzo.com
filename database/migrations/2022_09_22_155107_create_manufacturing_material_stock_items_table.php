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
        Schema::create('manufacturing_material_stock_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("manufacturing_material_id");
            $table->unsignedBigInteger("stock_item_id");
            $table->float("quantity");
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
        Schema::dropIfExists('manufacturing_material_stock_items');
    }
};
