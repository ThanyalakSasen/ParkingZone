<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ParkingFloor;
use App\Models\ParkingSpot;

class ParkingSpotDefualtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parkingFloors = [
            [
                'floor' => 1,
                'name' => 'สำหรับมอเตอร์ไซต์'
            ],
            [
                'floor' => 2,
                'name' => 'สำหรับรถยนต์'
            ],
            [
                'floor' => 3,
                'name' => 'สำหรับรถยนต์'
            ]
        ];

        foreach ($parkingFloors as $parkingFloor) {
            ParkingFloor::firstOrCreate(
                ['floor' => $parkingFloor['floor']],
                $parkingFloor
            );
        }

        $parkingSpots = [];
        for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j < 33; $j++) {
                if ($i == 1) {
                    $parkingSpots[] = [
                        'spot_number' => 'A' . $j,
                        'parking_floor_id' => $i,
                        'is_available' => true,
                        'spot_type' => 'มอเตอร์ไซต์',
                    ];
                } else if ($i == 2) {
                    $parkingSpots[] = [
                        'spot_number' => 'B' . $j,
                        'parking_floor_id' => $i,
                        'is_available' => true,
                        'spot_type' => 'รถยนต์',
                    ];
                } else if ($i == 3) {
                    $parkingSpots[] = [
                        'spot_number' => 'C' . $j,
                        'parking_floor_id' => $i,
                        'is_available' => true,
                        'spot_type' => 'รถยนต์',
                    ];
                }
            }
        }

        foreach ($parkingSpots as $spot) {
            ParkingSpot::firstOrCreate(
                [
                    'spot_number' => $spot['spot_number'],
                    'parking_floor_id' => $spot['parking_floor_id']
                ],
                $spot
            );
        }
    }
}
