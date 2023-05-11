<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BulletinBoard;
use App\Models\User;

class BulletinBoardFactory extends Factory
{
    protected $model = BulletinBoard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 임의의 사용자를 얻거나 존재하지 않는 경우 새로 만든다
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();
        $created_at = $this->faker->dateTimeThisYear;
        return [
            'user_id' => $user->id,
            'subject' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
