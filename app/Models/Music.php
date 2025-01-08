<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    // Jadvalga kiritilishi mumkin bo‘lgan ustunlar
    protected $fillable = [
        'name', // Musiqa nomi
        'artist', // Artist nomi
        'file', // Fayl yo‘li
        'user_id', // Musiqani yuklagan foydalanuvchi ID si
        'admin_confirmed', // Admin tomonidan tasdiqlanganligini ko‘rsatadi
    ];

    /**
     * Musiqani yuklagan foydalanuvchini olish.
     */
    public function user()
    {
        return $this->belongsTo(User::class); // "Music" foydalanuvchi bilan bog‘langan
    }

    /**
     * Ushbu musiqani yoqtirgan foydalanuvchilarni olish.
     */
    public function likedMusics()
    {
        return $this->hasMany(LikedMusic::class); // "Music" yoqtirilgan musiqalar bilan bog‘langan
    }
}
