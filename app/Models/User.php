<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'is_admin'];
    
    protected $hidden = ['password', 'remember_token'];
    
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin ?? false;
    }
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function verifiedItems(): HasMany
    {
        return $this->hasMany(Item::class, 'verified_by');
    }
}