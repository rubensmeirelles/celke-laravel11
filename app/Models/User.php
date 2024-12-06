<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use OwenIt\Auditing\Contracts\Auditable;
use \OwenIt\Auditing\Auditable as AuditingAuditable;

class User extends Authenticatable implements Auditable
{
    use HasFactory, Notifiable, AuditingAuditable;

    protected $table = 'users';

   protected $fillable = [
        'name',
        'email',
        'password',
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
}
