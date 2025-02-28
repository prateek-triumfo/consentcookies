<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class UserConsent extends Model
{
    protected $fillable = [
        'user_identifier',
        'consent_category_id',
        'enabled',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ConsentCategory::class, 'consent_category_id');
    }
}
