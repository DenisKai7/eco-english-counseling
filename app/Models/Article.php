<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'category',
    ];

    // Relasi ke user (admin) yang membuat artikel
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}