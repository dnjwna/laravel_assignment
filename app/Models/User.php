<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    public $timestamps = true;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return (string) $this->getKey(); 
    }

    public function getJWTCustomClaims(): array
    {
        return ['role' => $this->role ?? 'student'];
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'id_instructor', 'id_user');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'id_user', 'id_user');
    }
}