<?php

use Illuminate\Database\Seeder;

class GolStartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataPlain = json_encode([
            [
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 1, 'status' => 'alive']
            ],
            [
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive']
            ],
            [
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 1, 'status' => 'dead'],
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 1, 'status' => 'alive']
            ],
            [
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'dead']
            ]
        ]);
        
        $dataFancy = json_encode([
            [
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead']
            ],
            [
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead']
            ],
            [
                ['blue' => 0, 'green' => 1, 'status' => 'alive'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive']
            ],
            [
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive']
            ],
            [
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 0, 'green' => 0, 'status' => 'dead'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive'],
                ['blue' => 1, 'green' => 0, 'status' => 'alive']
            ]
        ]);

        DB::table('gol_starts')->insert([ //,
            'seed_name' => "Plain",
            'seed_data' => $dataPlain
        ]);

        DB::table('gol_starts')->insert([ //,
            'seed_name' => "Fancy",
            'seed_data' => $dataFancy
        ]);
    }
}
