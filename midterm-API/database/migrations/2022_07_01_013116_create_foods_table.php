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
        Schema::create('foods', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("cateId");
            $table->foreign("cateId")->references("id")->on("categories")->onDelete("cascade")->onUpdate("cascade");
            $table->string("name", 100);
            $table->unsignedBigInteger("price");
            $table->string("description");
            $table->string("ingredients");
            $table->string("img");
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
        Schema::dropIfExists('foods');
    }
};
