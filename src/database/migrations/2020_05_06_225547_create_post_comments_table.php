<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('parent_id');
            $table->string('title');
            $table->boolean('published')
                ->default(0);
            $table->text('content')
                ->nullable()
                ->default(null);
            $table->timestamps();
            $table->index(['post_id']);
        });

        Schema::table('post_comments', function (Blueprint $table) {
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onUpdate('no action')
                ->onDelete('no action');

            $table->foreign('parent_id')
                ->references('id')
                ->on('post_comments')
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
        Schema::dropIfExists('post_comments');
    }
}
