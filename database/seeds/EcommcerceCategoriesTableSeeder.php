<?php

use App\Models\Ecommerce\Category;
use Illuminate\Database\Seeder;

class EcommcerceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'name'     => 'NYC',
                'position' => random_int(1, 100),
            ],
            [
                'name'     => 'Vagas',
                'position' => random_int(1, 100),
            ],
        ];

        $ids = [];

        foreach ($datas as $data) {
            $ids[] = Category::create($data)->id;
        }

        $subs = [
            [
                'name'      => 'Broadway',
                'parent_id' => $ids[0],
                'position'  => random_int(1, 100),
            ],
            [
                'name'      => 'Museum',
                'parent_id' => $ids[0],
                'position'  => random_int(1, 100),
            ],
            [
                'name'      => 'Concert',
                'parent_id' => $ids[0],
                'position'  => random_int(1, 100),
            ],

            [
                'name'      => 'Shows',
                'parent_id' => $ids[1],
                'position'  => random_int(1, 100),
            ],
            [
                'name'      => 'Museum',
                'parent_id' => $ids[1],
                'position'  => random_int(1, 100),
            ],
            [
                'name'      => 'Concert',
                'parent_id' => $ids[1],
                'position'  => random_int(1, 100),
            ],
        ];

        foreach ($subs as $sub) {
            Category::create($sub);
        }
    }
}
