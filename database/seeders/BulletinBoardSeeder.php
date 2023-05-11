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
        BulletinBoard::factory(3)->create();
    }
}
