<?php
namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // "index" metodi admin uchun asosiy sahifani ko‘rsatadi
    public function index()
    {
        // Barcha musiqalarni "Music" modelidan olish
        $musics = Music::all();

        // Musiqalar sonini hisoblash
        $sum = Music::all()->sum(function ($music) {
            return 1; // Har bir musiqa uchun 1 ni qo‘shamiz
        });

        // Musiqalar va umumiy sonni "admin.home" ko‘rinishiga uzatamiz
        return view('admin.home', compact('musics', 'sum'));
    }
}
