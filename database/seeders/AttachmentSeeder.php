<?php

namespace Database\Seeders;

use App\Models\Attachment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 사용자를 위한 첨부파일 생성
        $users = User::all();
        if ($users->isEmpty()) {
            echo "No users found.\n";
        } else {
            foreach ($users as $user) {
                echo "Creating attachment for user {$user->id}\n";
                $attachment = Attachment::factory()->make();
                $attachment->attachable_id = $user->id; // Set the attachable_id to the user's id
                $user->attachments()->save($attachment);
            }
        }

        // 게시물에 대한 첨부 파일 생성
        $posts = Post::all();
        if ($posts->isEmpty()) {
            echo "No posts found.\n";
        } else {
            foreach ($posts as $post) {
                echo "Creating attachment for post {$post->id}\n";
                $attachment = Attachment::factory()->make();
                $attachment->attachable_id = $post->id; // Set the attachable_id to the post's id
                $post->attachments()->save($attachment);
            }
        }
    }

}
