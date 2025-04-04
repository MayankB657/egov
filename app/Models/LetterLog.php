<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterLog extends Model
{
    protected $table = 'letter_log';
    public $primaryKey = 'id';
    public $timestamps = true;
}
