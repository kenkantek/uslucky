<?php

use App\Models\Game;
use Illuminate\Database\Seeder;

class ManageGameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $powerball       = Game::find(1);
        $powerball_value = [
            'hours_before_close' => 9,
            'each_per_ticket'    => 2,
            'extra_per_ticket'   => 1,

        ];

        foreach ($powerball_value as $key => $value) {
            $powerball->newOrUpdateSetting()
                ->withKey($key)
                ->withValue($value)
                ->publish();
        }
        
        $mega       = Game::find(2);
        $mega_value = [
            'hours_before_close' => 9,
            'each_per_ticket'    => 2,
            'extra_per_ticket'   => 1,

        ];

        foreach ($mega_value as $key => $value) {
            $mega->newOrUpdateSetting()
                ->withKey($key)
                ->withValue($value)
                ->publish();
        }

    }
}
