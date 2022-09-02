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
            $table->unsignedBigInteger("inventory_category_id");
            $table->String("name");
            $table->Text("description")->nullable();
            $table->unsignedBigInteger("unit_type_id");
            $table->boolean("is_manufactured")->default(false);
            $table->boolean("is_material")->default(false);
            $table->boolean("is_product")->default(false);
            $table->unsignedBigInteger("default_unit_id");
            $table->decimal("reorder_level");
            $table->decimal("in_stock");
            $table->String("featured_image");
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
