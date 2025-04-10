<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class UserImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function collection(Collection $rows)
    {
        $role = Role::firstOrCreate(['name' => 'User']);
        foreach ($rows as $row) {
            if (
                empty($row['name']) || empty($row['password']) || empty($row['email'])
            ) {
                continue;
            }
            $existingUser = User::where('email', $row['email'])->first();
            if ($existingUser) {
                continue;
            }
            $user = User::create(
                [
                    'name' => $row['name'],
                    'password' => Hash::make($row['contact']),
                    'email' => $row['email'],
                    'address' => $row['address'],
                    'language' => 'en',
                ]
            );
            $user->assignRole($role);
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
