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
        Schema::create('inventory_item_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("source_inv_items_id");
            $table->unsignedBigInteger("material_inv_items_id");
            $table->decimal("quantity");
            $table->enum("type",["RAW","WASTAGE"]);
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
        Schema::dropIfExists('inventory_item_materials');
    }
};
