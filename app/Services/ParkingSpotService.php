<?php

namespace App\Services;

class ParkingSpotService
{
    public function transformFloors($floors)
    {
        $result = [];
        foreach ($floors as $floor) {
            $floorData = [
                'id' => $floor->id,
                'name' => $floor->name,
                'floor' => $floor->floor,
                'spots' => $this->transfromSpot($floor->parkingSpots),
            ];
            $result[] = $floorData;
        }
        return $result;
    }

    public function transfromSpot($spots)
    {
        $data = [];
        foreach ($spots as $spot) {
            $data[] = [
                'id' => $spot->id,
                'spot_number' => $spot->spot_number,
                'is_available' => $spot->is_available,
                'spot_type' => $spot->spot_type,
            ];
        }
        return $data;
    }
}
