<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToCollection, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $classroom_id;
    public function __construct($classroom_id)
    {
        $this->classroom_id = $classroom_id;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            User::create([
                'classroom_id'=> $this->classroom_id,
                'nisn'              => $row[1],
                'name'              => $row[2],
                'email'             => $row[3],
                'password'          => Hash::make($row[4]),
            ])->assignRole('student');
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
