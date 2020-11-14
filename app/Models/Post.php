<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'foodname',
    //     'description',
    //     'cuisine',
    //     'cost',
    //     'qty',
    //     'image',
    // ];

    // did not assign fillable since we have Auth users and declare the data fields
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}