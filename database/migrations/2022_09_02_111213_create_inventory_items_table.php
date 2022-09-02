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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("inv_categories_id");
            $table->String("name");
            $table->Text("description")->nullable();
            $table->unsignedBigInteger("unit_types_id");
            $table->unsignedTinyInteger("is_manufactured");
            $table->unsignedTinyInteger("is_material");
            $table->unsignedTinyInteger("is_product");
            $table->unsignedBigInteger("default_units_id");
            $table->decimal("reorder_level");
            $table->decimal("in_stock");
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
        Schema::dropIfExists('inventory_items');
    }
};
