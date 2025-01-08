<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LikedMusic;
use App\Models\Music;

class LikedMusicController extends Controller
{
    // Foydalanuvchi musiqani yoqtirganlar ro‘yxatiga qo‘shishi uchun metod
    public function like(Request $request, $musicId)
    {
        $user = auth()->user(); // Hozirgi tizimga kirgan foydalanuvchini olish

        // Agar musiqani yoqtirganlar ro‘yxatida hali mavjud bo‘lmasa
        if (!$user->likedMusicItems->contains($musicId)) {
            // "LikedMusic" modeliga yangi yozuv qo‘shish
            LikedMusic::create([
                'user_id' => $user->id,
                'music_id' => $musicId,
            ]);
        }

        // Foydalanuvchini oldingi sahifaga qaytarish va xabar ko‘rsatish
        return back()->with('success', 'Musiqa muvaffaqiyatli yoqtirildi!');
    }

    // Foydalanuvchi musiqani yoqtirganlar ro‘yxatidan olib tashlashi uchun metod
    public function unlike(Request $request, $musicId)
    {
        $user = auth()->user(); // Hozirgi tizimga kirgan foydalanuvchini olish

        // Yoqtirgan musiqani "LikedMusic" jadvalidan topish
        $likedMusic = LikedMusic::where('user_id', $user->id)
            ->where('music_id', $musicId)
            ->first();

        // Agar musiqa topilgan bo‘lsa, uni o‘chirish
        if ($likedMusic) {
            $likedMusic->delete();
        }

        // Foydalanuvchini oldingi sahifaga qaytarish va xabar ko‘rsatish
        return back()->with('success', 'Musiqa muvaffaqiyatli yoqtirilmaganlar ro‘yxatiga o‘tqazildi!');
    }

    /**
     * Tizimga kirgan foydalanuvchi uchun barcha yoqtirilgan musiqalarni olish.
     */
    public function index()
    {
        // Yoqtirilgan musiqalarni olish
        $musics = Music::whereHas('likedMusics', function ($query) {
            $query->where('user_id', auth()->id()); // Faqat hozirgi foydalanuvchi uchun
        })->get();

        // Musiqalarning umumiy sonini hisoblash (yoki boshqa biror xususiyatni yig‘ish, masalan, duration)
        $sum = $musics->sum(function ($likedMusic) {
            return 1; // Agar boshqa xususiyat (masalan, 'duration') bo‘lsa, uni hisoblash uchun o‘zgartiring
        });

        // "user.liked" ko‘rinishiga musiqalar va umumiy sonni uzatish
        return view('user.liked', compact('musics', 'sum'));
    }
}
