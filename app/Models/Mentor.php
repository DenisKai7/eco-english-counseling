<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mentor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'specialization',
        'phone_number',
        'bio',
        'user_id', // Tambahkan ini ke fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function materials() { return $this->hasMany(Material::class); }
    public function chats() { return $this->hasMany(Chat::class); }

    // Relasi baru: Satu Mentor dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}