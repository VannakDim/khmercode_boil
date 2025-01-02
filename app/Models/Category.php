<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];
    function posts(){
        return $this->belongsTo(Post::class);
    }
}
