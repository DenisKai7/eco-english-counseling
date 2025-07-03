<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'development_form_id',
        'mentor_id',
        'feedback_content',
    ];

    public function form()
    {
        return $this->belongsTo(DevelopmentForm::class, 'development_form_id');
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}