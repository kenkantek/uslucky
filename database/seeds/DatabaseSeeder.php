<?php

use Illuminate\Database\Seeder;
use Sofa\Eloquence\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(ManageGameTableSeeder::class);

        Model::reguard();
    }
}
