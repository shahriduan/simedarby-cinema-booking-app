<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Cinema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'name' => 'Putrajaya',
                'cinemas' => [
                    [
                        'name' => 'GSC - IOI City Mall'
                    ]
                ]
            ],
            [
                'name' => 'Subang Jaya',
                'cinemas' => [
                    [
                        'name' => 'GSC - Subang Parade'
                    ]
                ]
            ]
        ];

        foreach ($areas as $area) {
            $areaModel = Area::firstOrCreate([
                'name' => $area['name'],
            ]);

            foreach ($area['cinemas'] as $cinema) {
                Cinema::firstOrCreate([
                    'area_id' => $areaModel->id,
                    'name' => $cinema['name'],
                ]);
            }
        }
    }
}
