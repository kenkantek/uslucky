<?php

use App\Models\Game;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create(['name' => 'Powerball']);
        Game::create(['name' => 'Mega Millions']);
    }
}
