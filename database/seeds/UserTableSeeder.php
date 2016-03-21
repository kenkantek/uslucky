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
        factory(App\Models\User::class, 5)->create()->each(function ($u) {
            if ($u->id == 1) {
                $u->email = 'admin@gmail.com';
                $u->save();
                $u->assignRole('admin');
            } else {
                $u->assignRole('player');
            }
        });
    }
}
