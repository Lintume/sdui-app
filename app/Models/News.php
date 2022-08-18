<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'created_at', 'updated_at'];

    public function news()
    {
        return $this->belongsTo(News::class, 'user_id');
    }
}
