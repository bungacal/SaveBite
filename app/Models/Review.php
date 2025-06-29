<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reviewer_photo',
        'reviewing_as',
        'submission_date',
        'letter',
        'is_approved'
    ];

    protected $casts = [
        'submission_date' => 'date',
        'is_approved' => 'boolean'
    ];

    /**
     * Scope untuk review yang sudah diapprove
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope untuk review yang pending
     */
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    /**
     * Get formatted submission date
     */
    public function getFormattedDateAttribute()
    {
        return $this->submission_date->format('F j, Y');
    }

    /**
     * Get photo URL
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->reviewer_photo) {
            return asset('storage/' . $this->reviewer_photo);
        }
        return asset('gambar/default-reviewer.jpg');
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return $this->is_approved ? 'Approved' : 'Pending';
    }

    /**
     * Get excerpt of review letter
     */
    public function getExcerptAttribute($length = 150)
    {
        if (strlen($this->letter) > $length) {
            return substr($this->letter, 0, $length) . '...';
        }
        return $this->letter;
    }

    /**
     * Get short letter for display
     */
    public function getShortLetterAttribute()
    {
        return \Str::limit($this->letter, 200);
    }

    /**
     * Get user type badge class for CSS
     */
    public function getUserTypeBadgeClassAttribute()
    {
        $typeMap = [
            'Food Donor' => 'badge-food-donor',
            'Food Receiver' => 'badge-food-receiver'
        ];

        return $typeMap[$this->reviewing_as] ?? 'badge-default';
    }
}