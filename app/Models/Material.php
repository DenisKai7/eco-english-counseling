<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'level',
        'mentor_id',
        'image_path', // Tambahkan ini
        'audio_path', // Tambahkan ini
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}