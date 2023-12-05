<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "body",
        "is_published",
        "image",
        "published_at",
        "featured",
        "is_profile_update",
        "shared_post",
        "shared"
    ];

    public function scopePublished($query)
    {
        return $query->where("is_published", 1);
    }

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }


    public function image()
    {
        if (isset($this->image)) {
            return asset("storage/" . $this->image);
        }
        return asset("images/empty-image.png");
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


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, "likes")->withTimestamps();
    }
}
