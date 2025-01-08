<?php
namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Foydalanuvchi uchun bosh sahifa
    public function index()
    {
        // Barcha musiqalarni olish
        $musics = Music::all();

        // Musiqalarning umumiy sonini hisoblash
        $sum = Music::all()->sum(function ($music) {
            return 1; // Har bir musiqa uchun 1 ni qo‘shish
        });

        // "user.home" ko‘rinishini ochish va ma’lumotlarni uzatish
        return view('user.home', compact('musics', 'sum'));
        // Eslatma: "user.home" uchun Blade fayli yarating.
    }

    // Musiqalarni qidirish funksiyasi
    public function search(Request $request)
    {
        // Foydalanuvchi kiritgan qidiruv so‘rovi
        $query = $request->input('query');

        if ($query) {
            // Musiqa nomi yoki artist nomi bo‘yicha qidirish
            $musics = Music::where('name', 'LIKE', "%$query%")
                ->orWhere('artist', 'LIKE', "%$query%")
                ->get();
        } else {
            // Agar qidiruv bo‘lmasa, barcha musiqalarni ko‘rsatish
            $musics = Music::all();
        }

        // Qidiruv natijalarini "user.search" ko‘rinishiga uzatish
        return view('user.search', compact('musics'));
    }
}
