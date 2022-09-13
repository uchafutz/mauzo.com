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
        Schema::create('manufacturings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("inventory_item_id");
            $table->unsignedBigInteger("config_unit_id");
            $table->decimal("quantity")->default(0);
            $table->enum("status", ['CREATED', 'BOQ', 'PROCESSED'])->default("CREATED");
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
        Schema::dropIfExists('manufacturings');
    }
};
