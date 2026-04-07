<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    public function assignedChores()
    {
        return $this->hasMany(Chore::class, 'assigned_to');
    }

    public function createdChores()
    {
        return $this->hasMany(Chore::class, 'assigned_by');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'created_by');
    }
}
