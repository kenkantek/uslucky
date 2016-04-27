<?php

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->powerball();
        $this->magamillions();
    }

    private function powerball()
    {
        $awards = [
            'Fail'    => 0,
            'Jackpot' => 0,
            'Prize 2' => 1000000,
            'Prize 3' => 50000,
            'Prize 4' => 100,
            'Prize 5' => 100,
            'Prize 6' => 7,
            'Prize 7' => 7,
            'Prize 8' => 4,
            'Prize 9' => 4,
        ];
        $i = 0;
        foreach ($awards as $k => $award) {
            Level::create([
                'game_id' => 1, //Powerball
                'level'   => $i,
                'label'   => $k,
                'award'   => $award,
            ]);
            $i++;
        }
    }

    private function magamillions()
    {
        $awards = [
            'Fail'    => 0,
            'Jackpot' => 0,
            'Prize 2' => 1000000,
            'Prize 3' => 5000,
            'Prize 4' => 500,
            'Prize 5' => 50,
            'Prize 6' => 5,
            'Prize 7' => 5,
            'Prize 8' => 2,
            'Prize 9' => 1,
        ];
        $i = 0;
        foreach ($awards as $k => $award) {
            Level::create([
                'game_id' => 2, //Mega Millions
                'level'   => $i,
                'label'   => $k,
                'award'   => $award,
            ]);
            $i++;
        }
    }
}
