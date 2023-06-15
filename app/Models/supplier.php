<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // public function order()
    // {
    //     return $this->hasOneThrough(Order::class,Book::class,'supplier_id','book_id');
    // }

}
