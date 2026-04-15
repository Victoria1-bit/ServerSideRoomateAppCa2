<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// The main User model — extends Authenticatable so Laravel can use it for login/auth
class User extends Authenticatable
{
    // HasFactory: allows creating fake users in tests/seeders via User::factory()
    // Notifiable: enables sending notifications (email, SMS, etc.) to this user
    use HasFactory, Notifiable;

    // Fields that are allowed to be mass-assigned (e.g. via User::create([...]))
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Either 'admin' or 'member'
    ];

    // Fields that are never included when the model is serialized to JSON or an array
    // Keeps sensitive data from being accidentally exposed in API responses or views
    protected $hidden = [
        'password',
        'remember_token', // Used by Laravel's "remember me" login feature
    ];

    // Helper method to check if this user is an admin
    // Using strtolower() ensures the check works regardless of how the role is capitalised in the DB
    public function isAdmin()
    {
        return strtolower($this->role) === 'admin';
    }
}