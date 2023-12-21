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
        "body",
        "visibility",
        "image",
        "published_at",
        "is_profile_update",
        "shared_post",
        "shared"
    ];

    // General scope for visibility
    public function scopeVisibility($query, $visibility)
    {
        return $query->where('visibility', $visibility);
    }

    // Specific scopes for each visibility type
    public function scopePublic($query)
    {
        return $this->scopeVisibility($query, 'public');
    }

    public function scopePrivate($query)
    {
        return $this->scopeVisibility($query, 'private');
    }

    public function scopeFriends($query)
    {
        return $this->scopeVisibility($query, 'friends');
    }

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function sharedPost()
    {
        return $this->belongsTo(Post::class, 'shared_post', 'id');
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
