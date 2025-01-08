<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikedMusicController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Avtorizatsiya marshrutlari
Route::middleware('guest')->group(function () {
    // Login formasini ko‘rsatish
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    // Login funksiyasini ishlov berish
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    // Ro‘yxatdan o‘tish formasini ko‘rsatish
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    // Ro‘yxatdan o‘tishni boshqarish
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    // Mehmon sahifasi
    Route::get('/', [AuthController::class, 'guest'])->name('home');
});

// Logout marshruti (faqat avtorizatsiya qilingan foydalanuvchilar uchun)
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Foydalanuvchi marshrutlari
Route::middleware(['auth', 'role:user|admin'])->group(function () {
    // Foydalanuvchi bosh sahifasi
    Route::get('/user-home', [UserController::class, 'index'])->name('user.home');
    // Musiqa ro‘yxatini ko‘rsatish
    Route::get('/music', [MusicController::class, 'index'])->name('music.index');
    // Musiqalarni qidirish
    Route::get('/music/search', [UserController::class, 'search'])->name('music.search');
    // Yangi musiqa qo‘shish
    Route::post('/music', [MusicController::class, 'store'])->name('music.store');
    // Musiqa o‘chirish
    Route::delete('/music/{id}', [MusicController::class, 'destroy'])->name('music.destroy');
    // Musiqani yoqtirish
    Route::post('/music/{music}/like', [LikedMusicController::class, 'like'])->name('music.like');
    // Musiqani yoqtirishni bekor qilish
    Route::delete('/music/{music}/unlike', [LikedMusicController::class, 'unlike'])->name('music.unlike');
    // Yoqtirilgan musiqalar ro‘yxatini ko‘rsatish
    Route::get('/music/liked', [LikedMusicController::class, 'index'])->name('music.liked');
    // Musiqa qidiruvi (qayta yozilgan)
    Route::get('/music/search', [UserController::class, 'search'])->name('music.search');
});

// Admin marshrutlari
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin bosh sahifasi
    Route::get('/admin-home', [AdminController::class, 'index'])->name('admin.home');
});
