<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // Jika Anda menggunakan Sanctum

class User extends Authenticatable
{
    use HasFactory, Notifiable; // HasApiTokens jika menggunakan Sanctum

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    public function articles() { return $this->hasMany(Article::class, 'author_id'); }
    public function chats() { return $this->hasMany(Chat::class); }

    // Relasi baru: Satu User bisa menjadi satu Mentor (jika role-nya mentor)
    public function mentor()
    {
        return $this->hasOne(Mentor::class);
    }

    // Helper methods (opsional, tapi bagus untuk readability)
    public function isAdmin() { return $this->role === 'admin'; }
    public function isMentor() { return $this->role === 'mentor'; }
    public function isRegularUser() { return $this->role === 'user'; }
}