<?php

namespace App\Imports;

use App\compare;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new compare([
            'reg_number' => $row[0],
        ]);
    }
}
