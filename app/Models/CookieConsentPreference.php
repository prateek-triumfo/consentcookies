<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CookieConsentPreference extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'consent_given', 'consent_given_at'];

    // Optionally, you can define a relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
