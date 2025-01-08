<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedMusic extends Model
{
    use HasFactory;

    // Jadval nomi
    protected $table = 'liked_musics'; // Jadval nomi migratsiya faylidagi nom bilan mos ekanligini tekshiring

    // Jadvalga kiritilishi mumkin bo‘lgan ustunlar
    protected $fillable = [
        'user_id', // Foydalanuvchi ID si
        'music_id', // Musiqa ID si
    ];

    /**
     * Musiqani yoqtirgan foydalanuvchini olish
     */
    public function user()
    {
        return $this->belongsTo(User::class); // "LikedMusic" foydalanuvchi bilan bog‘langan
    }

    /**
     * Yoqtirilgan musiqani olish
     */
    public function music()
    {
        return $this->belongsTo(Music::class); // "LikedMusic" musiqa bilan bog‘langan
    }
}
