<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // public function books()
    // {
    //     return $this->belongsToMany(Book::class);
    // }

    public function books()
    {
        return $this->morphedByMany(Book::class,'taggables');
    }

}

