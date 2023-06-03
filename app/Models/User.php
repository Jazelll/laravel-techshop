<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public const ROLE_USER = 0;
    public const ROLE_ADMIN = 1;

    public const ACTIVE_USER = 'active';
    public const INACTIVE_USER = 'inactive';

    
    /*
    * override the role property
     * 0 for user
     * 1 for admin
     **/
    
    public function getRoleAttribute($value) {
        $roles = [
            self::ROLE_USER => 'user',
            self::ROLE_ADMIN => 'admin',
        ];

        return $roles[$value];
    }

    public function getStatusAttribute($value) {
        $status = [
            self::ACTIVE_USER => 'active',
            self::INACTIVE_USER => 'inactive',
        ];
    
        return $status[$value];
    }
    

    public function scopeFilter($query, $search) {
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('role', 'LIKE', '%' . $search . '%');
            });
        }

        return $query;
    }

}
