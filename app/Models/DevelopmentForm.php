<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevelopmentForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mentor_id',
        'form_type',
        'data',
    ];

    protected $casts = [
        'data' => 'array', // Otomatis cast kolom 'data' ke array/JSON
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mentor()
{
    return $this->belongsTo(Mentor::class); // Defaultnya akan mencari mentor_id
}

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}