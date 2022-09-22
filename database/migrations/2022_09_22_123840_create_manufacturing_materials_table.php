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
        Schema::create('manufacturing_materials', function (Blueprint $table) {
            $table->id();
            // protected $fillable = ["manufacturing_id", "inventory_item_material_id", "quantity", "inventory_stock_item_id"];
            $table->unsignedBigInteger("manufacturing_id");
            $table->unsignedBigInteger("inventory_item_material_id");
            $table->float("quantity");
            $table->unsignedBigInteger("inventory_stock_item_id")->nullable();
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
        Schema::dropIfExists('manufacturing_materials');
    }
};
