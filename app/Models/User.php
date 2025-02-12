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
        'bio',
        'image',
        'email',
        'password',
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

    //IDEAS RELATIONSHIP (USER HAS MANY IDEAS)
    public function ideas(){
        return $this->hasMany(Idea::class)->latest();
    }

    //COMMENTS RELATION
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //IMAGES
    public function getImageURL(){
        if($this->image){
            return url('storage/'.$this->image);
        }
        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={{$this->name}}";
    }

    //TWO METHODS 
    //FOR FOLLOWINGS RELATION
    //follower_id = our_id
    //user_id = followed users id
    public function followings(){ 
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }

    //FOR FOLLOWERS RELATION
    public function followers(){
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    //FOLLOW to UNFOLLOW
    public function follows(User $user){ 
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    //LIKE
    public function likes(){
        return $this->belongsTOMany(Idea::class, 'idea_like')->withTimestamps();
    }

    //LIKE to UNLIKE

    public function likesIdea(Idea $idea){ 
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }
}
