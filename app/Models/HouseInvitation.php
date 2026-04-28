<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseInvitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_id',
        'email',
        'invited_by',
        'status',
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function inviter()
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}
