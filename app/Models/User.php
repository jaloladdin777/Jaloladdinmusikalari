<?php

namespace App\Models;

// Laravel modullari va Spatie roli funksiyalarini ulash
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Jadvalga kiritilishi mumkin bo‘lgan ustunlar
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', // Foydalanuvchi ismi
        'email', // Foydalanuvchi emaili
        'password', // Foydalanuvchi paroli
    ];

    /**
     * Seriyalizatsiya uchun yashirilishi kerak bo‘lgan ustunlar
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', // Parol yashiriladi
        'remember_token', // "Remember Me" token yashiriladi
    ];

    /**
     * Jadval ustunlari ma'lumotlarini kasting qilish.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Email tasdiqlash vaqti
            'password' => 'hashed', // Parolni avtomatik hashlash
        ];
    }

    /**
     * Foydalanuvchi yoqtirgan musiqalarni olish.
     */
    public function likedMusicItems()
    {
        return $this->belongsToMany(
            Music::class, // Musiqa modeli bilan bog‘lanish
            'liked_musics', // O‘rta jadval nomi
            'user_id', // O‘rta jadvalda foydalanuvchi ID ustuni
            'music_id' // O‘rta jadvalda musiqa ID ustuni
        );
    }
}
