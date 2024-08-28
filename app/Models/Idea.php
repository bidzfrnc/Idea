<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    protected $withCount = ['likes'];
    /**
     * The attributes that are mass assignable.
     *
     * var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content'
    ];

    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at'
    // ];

    //COMMENTS RELATIONSHIP
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //USER RELATIONSHIP (IDEAS BELONGS TO USER)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //LIKES RELATION
    public function likes()
    {
        return $this->belongsTOMany(User::class, 'idea_like')->withTimestamps();
    }
}
