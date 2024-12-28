<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'user_id',
        'status',
        'is_featured',
        'views',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}