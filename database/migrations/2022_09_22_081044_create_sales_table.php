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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->dateTime("date");
            $table->string("description")->nullable();
            $table->unsignedBigInteger("customer_id");
            $table->decimal("total_amount", 17, 2);
            $table->decimal("received_amount", 17, 2);
            $table->decimal("return_amount", 17, 2);
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
        Schema::dropIfExists('sales');
    }
};