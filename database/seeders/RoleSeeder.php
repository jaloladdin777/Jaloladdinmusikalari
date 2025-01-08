<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Rollarni yaratish (agar mavjud bo‘lmasa)
        $adminRole = Role::firstOrCreate(['name' => 'admin']); // Admin roli
        $userRole = Role::firstOrCreate(['name' => 'user']); // Foydalanuvchi roli

        // Foydalanuvchilarga rollarni biriktirish
        $admin = User::find(1); // Admin foydalanuvchini olish (ID ni loyihangizga moslang)
        if ($admin) {
            $admin->assignRole($adminRole); // Admin rolini biriktirish
        }

        $user = User::find(2); // Oddiy foydalanuvchini olish (ID ni loyihangizga moslang)
        if ($user) {
            $user->assignRole($userRole); // Foydalanuvchi rolini biriktirish
        }
    }
}
