<?php

namespace Database\Factories;

use App\Models\BulletinBoard;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 임의의 사용자를 얻거나 존재하지 않는 경우 새로 만든다
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();
        $board = BulletinBoard::query()->inRandomOrder()->first() ?? BulletinBoard::factory()->create();

        return [
            'bulletin_board_id' => $board->id,
            'user_id' => $user->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'published_at' => $this->faker->dateTimeThisYear,
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
