<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Agar ro‘llar mavjud bo‘lmasa, ularni yaratish
        $adminRole = Role::create(['name' => 'admin']); // Admin roli
        $userRole = Role::create(['name' => 'user']); // Foydalanuvchi roli

        // Admin foydalanuvchisini yaratish
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Email bo‘yicha tekshirish
            [
                'name' => 'Admin User', // Admin ismi
                'password' => bcrypt('password'), // Parolni hash qilish (Yaxshi parol bilan almashtiring)
            ]
        );
        // Admin foydalanuvchisiga "admin" rolini biriktirish
        $admin->assignRole($adminRole);

        // Oddiy foydalanuvchini yaratish
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'], // Email bo‘yicha tekshirish
            [
                'name' => 'Regular User', // Oddiy foydalanuvchi ismi
                'password' => bcrypt('password'), // Parolni hash qilish (Yaxshi parol bilan almashtiring)
            ]
        );
        // Oddiy foydalanuvchiga "user" rolini biriktirish
        $user->assignRole($userRole);
    }
}
