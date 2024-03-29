<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ["id", "sender", "receiver", "type", "body", "read", "is_shown_on_list", "is_shown"];

    public function sender_()
    {
        return $this->belongsTo(User::class, "sender");
    }

    public function receiver_()
    {
        return $this->belongsTo(User::class, "receiver");
    }

    public function date()
    {
        $date = "";
        if ($this->published_at !== null) {
            $date = Carbon::parse($this->published_at);
        } else {
            $date = Carbon::parse($this->created_at);
        }
        return $date->diffForHumans();
    }
}
