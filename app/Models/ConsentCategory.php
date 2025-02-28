<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsentCategory extends Model
{
    protected $fillable = [
        'name',
        'identifier',
        'description',
        'required',
        'default_enabled',
    ];

    protected $casts = [
        'required' => 'boolean',
        'default_enabled' => 'boolean',
    ];

    public function userConsents(): HasMany
    {
        return $this->hasMany(UserConsent::class);
    }
}
