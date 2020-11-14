<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function profileImage()
    {
           $imagePath = ($this->image) ? $this->image : '/profile/No_image.png';
            return '/storage/'.$imagePath;         
    }

    // profile will have many followers
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    
    // profile will belong to one user
    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
