<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ["id", "sender", "reciver", "type", "body"];

    public function sender()
    {
        return $this->belongsTo(User::class, "sender");
    }

    public function reciver()
    {
        return $this->belongsTo(User::class, "reciver");
    }
}
