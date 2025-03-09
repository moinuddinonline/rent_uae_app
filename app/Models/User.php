<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laratrust\Contracts\LaratrustUser;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements LaratrustUser, JWTSubject
{
    use HasRolesAndPermissions;
    use HasFactory, Notifiable;

    protected $appends = ['is_complete'];

    protected $fillable = [
        'username',
        'name',
        'email',
        'mobile_prefix',
        'mobile',
        'email_verified',
        'mobile_verified',
        'password',
        'image',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($entry) {
            do {
                $uniqueCode = Str::upper(rand(10, 9999) . Str::random(8) . rand(10, 9999));
            } while (self::where('username', $uniqueCode)->exists());
            $entry->username = $uniqueCode;
        });
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    // If a User Has Name And Email Updated and email_verified is 1 then is_complete will be 1
    public function getIsCompleteAttribute()
    {
        return $this->name && $this->email && $this->email_verified;
    }
}
