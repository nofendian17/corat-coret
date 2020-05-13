<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('parent_id');
            $table->string('title');
            $table->string('meta_title');
            $table->string('slug');
            $table->text('summary')->nullable();
            $table->boolean('published')->default(0);
            $table->dateTime('published_at')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);
            $table->timestamps();
            $table->index(['parent_id']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->onUpdate('no action')
                ->onDelete('no action');
            $table->foreign('parent_id')
                ->references('id')
                ->on('posts')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
