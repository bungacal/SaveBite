<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDonate extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_name',
        'donor_address',
        'donor_contact',
        'pickup_method',
        'food_name',
        'food_photo',
        'portion_quantity',
        'best_within',
        'status',
        'notes'
    ];

    // Status constants
    const STATUS_AVAILABLE = 'available';
    const STATUS_CLAIMED = 'claimed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_EXPIRED = 'expired';

    // Scope untuk donasi yang tersedia
    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    // Method untuk format status
    public function getStatusLabelAttribute()
    {
        $statusLabels = [
            self::STATUS_AVAILABLE => 'Available',
            self::STATUS_CLAIMED => 'Claimed',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_EXPIRED => 'Expired'
        ];

        return $statusLabels[$this->status] ?? 'Unknown';
    }

    // Method untuk cek apakah donasi masih aktif
    public function isActive()
    {
        return in_array($this->status, [self::STATUS_AVAILABLE, self::STATUS_CLAIMED]);
    }

    // Method untuk format display location (shortened)
    public function getShortAddressAttribute()
    {
        $words = explode(' ', $this->donor_address);
        if (count($words) > 8) {
            return implode(' ', array_slice($words, 0, 8)) . '...';
        }
        return $this->donor_address;
    }
}