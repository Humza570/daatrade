<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id')->nullable();
            
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('blog_sub_categories')->onDelete('cascade');
            $table->string('post_title')->nullable();
            $table->text('post_content')->nullable();
            $table->string('post_slug')->nullable();
            $table->string('featured_image')->nullable();
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
        Schema::dropIfExists('blog_posts');
    }
}
