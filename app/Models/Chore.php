<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model representing a single chore in the system
class Chore extends Model
{
    use HasFactory;

    // Fields that are allowed to be mass-assigned (e.g. via Chore::create([...]))
    // Any column not listed here will be ignored when mass assigning
    protected $fillable = [
        'title',
        'assigned_to', // ID of the user the chore is assigned to
        'assigned_by', // ID of the admin who created/assigned the chore
        'status',      // e.g. 'pending' or 'completed'
        'due_date',
    ];

    // Relationship: the user this chore is assigned to
    // Uses 'assigned_to' as the foreign key instead of the default 'user_id'
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relationship: the user who assigned/created this chore
    // Uses 'assigned_by' as the foreign key to distinguish from assignedUser
    public function assignedByUser()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}