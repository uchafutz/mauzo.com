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
    Schema::create("users_has_permissions", function(Blueprint $table){
         $table->id();
         $table->unsignedBigInteger("user_id");
         $table->unsignedBigInteger("permission_id");
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
        Schema::dropIfExists("users_has_permissions");
    }
};
