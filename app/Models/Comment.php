<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "post_id",
        "body",
    ];

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function date()
    {
        $date = Carbon::parse($this->created_at);
        return $date->diffForHumans();
    }
}
