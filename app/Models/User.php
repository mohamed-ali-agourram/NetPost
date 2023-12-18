<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasMergedRelationships;

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

    public function configuration()
    {
        return $this->hasOne(Config::class);
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

    public function notifications()
    {
        return $this->hasMany(Notification::class, "reciver")->orderBy('created_at', 'desc');
        ;
    }
    public function unreaded_notifications()
    {
        return $this->hasMany(Notification::class, "reciver")->where("read", false);
    }

    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')
            ->withPivot('accepted')
            ->withTimestamps();
    }

    public function pendingFriendsTo()
    {
        return $this->friendsTo()->wherePivot('accepted', false);
    }

    public function pendingFriendsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', false);
    }

    public function acceptedFriendsTo()
    {
        return $this->friendsTo()->wherePivot('accepted', true);
    }

    public function acceptedFriendsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', true);
    }

    public function friends()
    {
        return $this->mergedRelationWithModel(User::class, 'friends_view');
    }

    public function findFriendshipWith(?User $friend)
    {
        return DB::table('friendships')
            ->where(function ($query) use ($friend) {
                $query->where('user_id', $this->id)
                    ->where('friend_id', $friend->id);
            })
            ->orWhere(function ($query) use ($friend) {
                $query->where('friend_id', $this->id)
                    ->where('user_id', $friend->id);
            })
            ->first();
    }

    public function friendsRelation()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('accepted', 1)
            ->orWhere(function ($query) {
                $query->where('friend_id', $this->id)
                    ->where('accepted', 1);
            });
    }

    public function isFriendWith(User $otherUser)
    {
        return $this->friends()
            ->where('id', $otherUser->id)
            ->where('accepted', true)
            ->exists();
    }

    public function pendingRequestsRelation()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
            ->wherePivot('accepted', 0)
            ->orWhere(function ($query) {
                $query->where('friend_id', $this->id)
                    ->where('accepted', 0);
            });
    }

    public function pendingRequests()
    {
        return $this->mergedRelationWithModel(User::class, 'pending_requests_view');
    }

    public function has_liked(?Post $post)
    {
        if ($post !== null) {
            return $this->likes()->where("post_id", $post->id)->exists();
        }
    }
}
