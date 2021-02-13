<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_news', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("tags_id")->references("id")->on("tags")->cascadeOnDelete()->cascadeOnDelete();
            $table->foreignId("news_id")->references("id")->on("news")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('tags_news');
    }
}
