<?php

namespace Database\Seeders;

use App\Models\BulletinBoard;
use App\Models\User;
use Illuminate\Database\Seeder;

class BulletinBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->inRandomOrder()->first() ?? User::factory()->create();

        $bulletinBoards = [
            '자유게시판',
            '건의게시판',
            '신고게시판',
        ];

        foreach ($bulletinBoards as $subject) {
            BulletinBoard::create([
                'user_id' => $user->id,
                'subject' => $subject,
                'content' => '이곳은 ' . $subject . '입니다.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
