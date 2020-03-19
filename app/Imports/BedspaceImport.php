<?php

namespace App\Imports;

use App\bedspace;
use Maatwebsite\Excel\Concerns\ToModel;

class BedspaceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new bedspace([
            'programme_id' => $row[0],
            'year' => $row[1],
            'hall_name' => $row[2],
            'gender_for' => $row[3],
            'space' => $row[4],
            'room_from' => $row[5],
            'room_to' => $row[6],
            'occupants_per_room' => $row[7],    
        ]);
    }
}
