<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Music;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    // Tizimga kirgan foydalanuvchi uchun barcha musiqalarni ko‘rsatish
    public function index()
    {
        // Foydalanuvchiga tegishli musiqalarni olish
        $music = Music::where('user_id', Auth::id())->get();

        // "music.index" ko‘rinishini ochish va musiqalar ro‘yxatini uzatish
        return view('music.index', compact('music'));
    }

    // Yangi musiqa qo‘shish
    public function store(Request $request)
    {
        // Foydalanuvchi kiritgan ma'lumotlarni tekshirish
        $request->validate([
            'name' => 'required|string|max:255', // Musiqa nomi talab qilinadi
            'artist' => 'required|string|max:255', // Artist ismi talab qilinadi
            'file' => 'required|file|mimes:mp3,wav,aac|max:2048' // Faqat audio fayllar qabul qilinadi
        ]);

        // Yuklangan faylni saqlash
        $filePath = $request->file('file')->store('music', 'public');

        // Musiqa yozuvini yaratish
        Music::create([
            'name' => $request->name,
            'artist' => $request->artist,
            'file' => $filePath, // Saqlangan fayl yo‘li
            'user_id' => Auth::id(), // Tizimga kirgan foydalanuvchi ID si
            'admin_confirmed' => false, // Yangi musiqalar admin tasdiqlashini kutadi
        ]);

        // Foydalanuvchini asosiy sahifaga yo‘naltirish
        return redirect()->route('home')->with('success', 'Musiqa muvaffaqiyatli qo‘shildi!');
    }

    // Musiqani o‘chirish
    public function destroy($id)
    {
        // Berilgan ID bo‘yicha musiqani topish
        $music = Music::findOrFail($id);

        // Saqlangan faylni o‘chirish
        Storage::disk('public')->delete($music->file);

        // Musiqa yozuvini o‘chirish
        $music->delete();

        // Foydalanuvchini asosiy sahifaga yo‘naltirish
        return redirect()->route('home')->with('success', 'Musiqa muvaffaqiyatli o‘chirildi!');
    }
}
