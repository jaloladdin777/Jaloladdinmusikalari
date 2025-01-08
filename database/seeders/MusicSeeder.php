<?php

namespace Database\Seeders;

use App\Models\Music;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicSeeder extends Seeder
{
    /**
     * Ma'lumotlar bazasini to'ldirish uchun seederni ishga tushirish.
     */
    public function run(): void
    {
        // Yangi musiqa yozuvini yaratish
        Music::create([
            'name' => 'Song 1', // Musiqa nomi
            'artist' => 'Artist 1', // Artist nomi
            'file' => 'musics/seed1.mp3', // Musiqaning fayl yo'li
            'user_id' => 2, // Foydalanuvchi ID (real foydalanuvchi ID sini kiriting)
            'admin_confirmed' => true, // Admin tomonidan tasdiqlangan
        ]);
    }
}
