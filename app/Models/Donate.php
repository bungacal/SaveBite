<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    protected $table = 'donates';
    protected $fillable = [
        'donor_name',
        'donor_address',
        'donor_contact',
        'pickup_method',
        
        // Status tracking
        'status',
        'donation_date'
    ];

    protected $casts = [
        'donation_date' => 'datetime'
    ];

    // Relationship
    public function detailDonate()
    {
        return $this->hasOne(DetailDonate::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeByPickupMethod($query, $method)
    {
        return $query->where('pickup_method', $method);
    }
}