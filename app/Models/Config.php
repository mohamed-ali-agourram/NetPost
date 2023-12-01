<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'language',
        'notifications',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
