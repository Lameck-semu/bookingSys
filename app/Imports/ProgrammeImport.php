<?php

namespace App\Imports; 

use App\programmes;
use Maatwebsite\Excel\Concerns\ToModel;

class ProgrammeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new programmes([
            'programme_code' => $row[0],
            'programme_name' => $row[1],
        ]);
    }
}
