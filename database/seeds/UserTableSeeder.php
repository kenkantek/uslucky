<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function ($u) {
            if ($u->id == 1) {
                $u->assignRole('admin');
            } else {
                $u->assignRole('player');
            }
        });
    }
}
