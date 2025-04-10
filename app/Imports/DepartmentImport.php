<?php

namespace App\Imports;

use App\Models\Department;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepartmentImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function collection(Collection $rows)
    {
        $userId = Auth::id();

        foreach ($rows as $row) {
            if (
                empty($row['name']) || empty($row['contact']) || empty($row['email'])
            ) {
                continue;
            }
            Department::firstOrCreate(
                [
                    'name' => $row['name'],
                    'contact' => $row['contact'],
                    'email' => $row['email'],
                ],
                [
                    'created_by' => $this->userId
                ]
            );
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
