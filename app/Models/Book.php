<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'picture',
        'download',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function comment()
    {
        return $this->morphOne(Comment::class,'commentable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(tag::class,'taggables');
    }

}
