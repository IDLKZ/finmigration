<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("author_id")->references("id")->on("users")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("category_id")->references("id")->on("categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->string("alias");
            $table->string("title");
            $table->string("subtitle");
            $table->text("content");
            $table->string("thumbnail");
            $table->string("img");
            $table->string("img_description");
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
        Schema::dropIfExists('news');
    }
}
