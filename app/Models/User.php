<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    protected $table = 'users';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'is_admin',
        'email_verified_at',
        'last_active_at',
        'is_online',
        'token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sociallogin(): HasMany
    {
        return $this->hasMany(SocialLogin::class, 'users_id');
    }

    public function getUserRoleName()
    {
        return $this->getRoleNames()->first();
    }

    public function devices(): HasMany
    {
        return $this->hasMany(RememberDevices::class, 'users_id');
    }
}
