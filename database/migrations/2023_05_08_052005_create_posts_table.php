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
        // Schema::create('posts', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained();
        //     $table->foreignId('bulletin_board_id')->constrained();
        //     $table->string('title');
        //     $table->text('content');
        //     $table->datetime('published_at')->nullable();
        //     $table->timestamps();
        // });
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('bulletin_board_id')->constrained();
            $table->string('title');
            $table->text('content');
            $table->datetime('published_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id') // 외래키 지정
                  ->references('id')->on('users')
                  ->onDelete('cascade'); // 삭제 시 동작 설정
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
