<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'picture',
        'profileable_type',
        'profileable_id',
    ];

    public function profileable()
    {
        return $this->morphTo();
    }

}
