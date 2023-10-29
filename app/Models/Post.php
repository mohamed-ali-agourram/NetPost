<?php

namespace App\Models;

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
        "featured"
    ];

    public function author(){
        return $this->belongsTo(User::class, "user_id");
    }


    public function image()
    {
        if(isset($this->image))
        {
            return  asset("storage/".$this->image);
        }
        return asset("images/empty-image.png");
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
