<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'profile_id',
        'contact_type',
        'label',
        'value',
        'url',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}