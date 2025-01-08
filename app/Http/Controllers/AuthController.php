<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mehmon foydalanuvchilar uchun sahifani ko‘rsatish
    public function guest()
    {
        // Agar foydalanuvchi tizimga kirgan bo‘lsa
        if (Auth::check()) {
            // Foydalanuvchi "admin" ro‘liga ega bo‘lsa, admin boshqaruv paneliga yo‘naltiriladi
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.home')->with('success', 'Admin boshqaruv paneliga xush kelibsiz!');
            }
            // Agar "user" ro‘li bo‘lsa, foydalanuvchi boshqaruv paneliga yo‘naltiriladi
            elseif (auth()->user()->hasRole('user')) {
                return redirect()->route('user.home')->with('success', 'Foydalanuvchi boshqaruv paneliga xush kelibsiz!');
            }
        } else {
            // Tizimga kirmagan foydalanuvchilar uchun mehmon sahifasini ko‘rsatish
            return view('guest/home');
        }
    }

    // Login formani ko‘rsatish
    public function showLoginForm()
    {
        return view('auth.login'); // Login uchun Blade fayl
    }

    // Login funksiyasini ishlov berish
    public function login(Request $request)
    {
        // Kiruvchi so‘rovni tekshirish
        $request->validate([
            'email' => 'required|email', // Email maydoni talab qilinadi
            'password' => 'required', // Parol talab qilinadi
        ]);

        // Login jarayoni
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Foydalanuvchi ro‘liga qarab yo‘naltirish
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.home')->with('success', 'Admin boshqaruv paneliga xush kelibsiz!');
            } elseif (auth()->user()->hasRole('user')) {
                return redirect()->route('home')->with('success', 'Foydalanuvchi boshqaruv paneliga xush kelibsiz!');
            }
        }

        // Login muvaffaqiyatsiz bo‘lsa
        return back()->withErrors(['email' => 'Kiritilgan maʼlumotlar bazamizdagi maʼlumotlarga mos kelmadi.']);
    }

    // Ro‘yxatdan o‘tish formasi ko‘rsatiladi
    public function showRegisterForm()
    {
        return view('auth.register'); // Ro‘yxatdan o‘tish uchun Blade fayl
    }

    // Ro‘yxatdan o‘tishni boshqarish
    public function register(Request $request)
    {
        // Ro‘yxatdan o‘tish uchun so‘rovni tekshirish
        $request->validate([
            'name' => 'required|string|max:255', // Ism maydoni talab qilinadi
            'email' => 'required|email|unique:users', // Email yagona bo‘lishi kerak
            'password' => 'required|confirmed|min:6', // Parol tasdiqlanishi va minimal 6 belgidan iborat bo‘lishi kerak
        ]);

        // Yangi foydalanuvchini yaratish
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Parolni himoyalash uchun bcrypt
        ]);

        // Foydalanuvchiga "user" ro‘li biriktiriladi
        $user->assignRole('user'); // Standart foydalanuvchi ro‘li

        return redirect()->route('login.form')->with('success', 'Ro‘yxatdan o‘tish muvaffaqiyatli yakunlandi! Iltimos, tizimga kiring.');
    }

    // Logout funksiyasi
    public function logout(Request $request)
    {
        // Foydalanuvchini tizimdan chiqarish
        Auth::logout();

        // Sessiyani bekor qilish
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Bosh sahifaga qaytish
        return redirect('/')->with('success', 'Tizimdan muvaffaqiyatli chiqdingiz.');
    }
}
