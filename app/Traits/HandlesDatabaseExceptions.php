<?php

namespace App\Traits;

use Illuminate\Database\QueryException;

trait HandlesDatabaseExceptions
{
    public function handleDatabaseException(QueryException $e)
    {
        if ($e->getCode() == '23000') {
            return redirect()->back()->with('error', 'The email address is already in use. Please choose a different email.');
        }
        return redirect()->back()->with('error', $e->getMessage());
    }
}
