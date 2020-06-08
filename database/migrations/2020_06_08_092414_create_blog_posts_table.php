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
            $table->unsignedBigInteger('author_id',false)->index()->nullable(); //since auth is not ready
            $table->unsignedBigInteger('post_category_id',false)->index();
            $table->string('slug',150)->unique();
            $table->string('title',70)->unique();
            $table->text('body');
            $table->string('image');
            $table->tinyInteger('status')->default(0);  //0 for hidden , 1 for visible
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_category_id')->references('id')->on('blog_post_categories')->onDelete('cascade');
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
