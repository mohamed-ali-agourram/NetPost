<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cover_image',
        'profile_image',
        'status',
        'slug'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile_image()
    {
        if (isset($this->profile_image)) {
            return asset("storage/" . $this->profile_image);
        }
        return asset("images/default-profile.png");
    }

    public function cover_image()
    {
        if (isset($this->cover_image)) {
            return asset("storage/" . $this->cover_image);
        }
        return asset("images/cover_pic.jpg");
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, "likes")->withTimestamps();
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendship', 'sender', 'receiver')
            ->wherePivot('friendship.status', 'accepted')
            ->orWhere(function ($query) {
                $query->where('friendship.receiver', $this->id)
                    ->where('friendship.status', 'accepted');
            });
    }

    public function pendingFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friendship', 'receiver', 'sender')
            ->wherePivot('status', 'pending')
            ->where('sender', $this->id)
            ->orWhere('receiver', $this->id);
    }

    public function areFriends(User $otherUser)
    {
        return $this->friends()
            ->wherePivot('status', 'accepted')
            ->where(function ($query) use ($otherUser) {
                $query->where('sender', $otherUser->id)
                    ->orWhere('receiver', $otherUser->id);
            })
            ->exists();
    }

    public function has_liked(?Post $post)
    {
        if ($post !== null) {
            return $this->likes()->where("post_id", $post->id)->exists();
        }
    }
}
