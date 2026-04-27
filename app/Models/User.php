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
        'photo',
        'household_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return in_array(strtolower($this->role ?? 'member'), ['admin', 'super_admin']);
    }

    public function isSuperAdmin()
    {
        return strtolower($this->role ?? 'member') === 'super_admin';
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=10a37f&color=fff';
    }
}