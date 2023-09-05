<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body', 'user_id', 'product_id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
