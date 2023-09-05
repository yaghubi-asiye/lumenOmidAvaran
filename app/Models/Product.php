<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'brand'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
