<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialLogin extends Model
{
    use HasFactory;

    protected $table = 'social_login';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'key',
        'users_id',
        'type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
