<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attachment;
use App\Models\User;
use App\Models\Post;

class AttachmentFactory extends Factory
{
     protected $model = Attachment::class;

     public function definition()
     {
         $attachableTypes = [User::class, Post::class];
         $attachableType = $this->faker->randomElement($attachableTypes);

         // 존재하지 않는 경우 사용자 또는 게시물을 생성
         if (User::count() === 0) {
             User::factory()->create();
         }
         if (Post::count() === 0) {
             Post::factory()->create();
         }

         $attachable = $attachableType::query()->inRandomOrder()->first();

         // attachableType을 기반으로 attachableId를 설정
         $attachableId = $attachableType === User::class ? $attachable->email : $attachable->id;

         return [
             'file_path' => $this->faker->imageUrl(),
             'attachable_id' => $attachableId,
             'attachable_type' => $attachableType,
             'created_at' => $this->faker->dateTimeThisYear,
             'updated_at' => $this->faker->dateTimeThisYear,
         ];
     }
}
