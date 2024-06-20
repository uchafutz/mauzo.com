<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("account_id");
            $table->unsignedBigInteger("sale_id")->nullable();
            $table->text("description")->nullable();
            $table->dateTime("date")->default(Carbon::now());
            $table->decimal("amount",17,2);
            $table->string("credit")->nullable();
            $table->string("debit")->nullable();
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
        Schema::dropIfExists('account_ledgers');
    }
};
