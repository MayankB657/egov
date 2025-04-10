<?php

namespace App\Imports;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BranchImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function collection(Collection $rows)
    {
        $userId = Auth::id();

        foreach ($rows as $row) {
            if (
                empty($row['department_name']) || empty($row['department_contact']) || empty($row['department_email']) ||
                empty($row['branch_name']) || empty($row['branch_contact']) || empty($row['branch_email']) || empty($row['branch_address'])
            ) {
                continue;
            }
            $department = Department::firstOrCreate(
                [
                    'name' => $row['department_name'],
                    'contact' => $row['department_contact'],
                    'email' => $row['department_email'],
                ],
                [
                    'created_by' => $userId,
                ]
            );
            Branch::firstOrCreate(
                [
                    'name' => $row['branch_name'],
                    'contact' => $row['branch_contact'],
                    'email' => $row['branch_email'],
                    'address' => $row['branch_address'],
                    'department_id' => $department->id
                ],
                [
                    'created_by' => $userId,
                ]
            );
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
