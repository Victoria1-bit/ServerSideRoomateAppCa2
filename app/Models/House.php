<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'housekeeper_id',
        'invite_code',
    ];

    public function housekeeper()
    {
        return $this->belongsTo(User::class, 'housekeeper_id');
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function chores()
    {
        return $this->hasMany(Chore::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
