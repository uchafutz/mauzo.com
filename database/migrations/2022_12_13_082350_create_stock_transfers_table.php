<?php

use Carbon\Carbon;
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
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->String("code");
            $table->dateTime("date")->default(Carbon::now());
            $table->unsignedBigInteger("from_warehouse_id");
            $table->unsignedBigInteger("to_warehouse_id");
            $table->unsignedBigInteger("operation_id");
            $table->enum("status", ["DRAFT", "SUBMITED"])->default("DRAFT");
            $table->String("description")->nullable();
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
        Schema::dropIfExists('stock_transfers');
    }
};