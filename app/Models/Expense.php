<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Expense extends Model
{
    protected $fillable = [
        'title',
        'category',
        'amount',
        'payment_status',
        'description',
        'split_type',
        'selected_users',
        'created_by',
    ];

    protected $casts = [
        'selected_users' => 'array',
        'amount' => 'decimal:2',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getSplitLabelAttribute(): string
    {
        return $this->split_type === 'selected'
            ? 'Selected roommates'
            : 'Everyone';
    }

    public function getSelectedUserNamesAttribute(): array
    {
        if (empty($this->selected_users) || !is_array($this->selected_users)) {
            return [];
        }

        return User::whereIn('id', $this->selected_users)
            ->pluck('name')
            ->toArray();
    }
}
