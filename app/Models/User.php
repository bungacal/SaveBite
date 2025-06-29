<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username', 
        'password',
        'phone',
        'register_as',
        'province',
        'city',
        'subdistrict',
        'postcode',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'username'; 
    }

    public function isAdmin(){
        return $this->email === 'admin@savebite.com';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getAttributeValue($this->getAuthIdentifierName());
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the full address of the user.
     *
     * @return string
     */
    public function getFullAddressAttribute()
    {
        return $this->address . ', ' . $this->subdistrict . ', ' . $this->city . ', ' . $this->province . ' ' . $this->postcode;
    }

    /**
     * Scope a query to only include users of a given register type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('register_as', $type);
    }

    /**
     * Scope a query to only include users from a given province.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $province
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromProvince($query, $province)
    {
        return $query->where('province', $province);
    }

    /**
     * Scope a query to only include users from a given city.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $city
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromCity($query, $city)
    {
        return $query->where('city', $city);
    }
}