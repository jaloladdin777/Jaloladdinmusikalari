
# Jaloladdinmusikalari

Bu loyiha Laravel dasturiy ta'minot freymvorki asosida qurilgan. Ushbu loyiha Laravelning asosiy funksiyalari va konfiguratsiyalarini o‘z ichiga oladi va rivojlanishni boshlash uchun tayyor platformani taqdim etadi.

## Talablar

Loyihani ishga tushirishdan oldin quyidagi dasturlar sizning tizimingizga o‘rnatilganligiga ishonch hosil qiling:

- PHP >= 8.0
- Composer
- Laravel Installer (ixtiyoriy, lekin tavsiya etiladi)
- Ma'lumotlar bazasi (masalan, MySQL, PostgreSQL, SQLite)
- Node.js va npm (front-end resurslari uchun)

## O‘rnatish

Loyihani lokal serveringizda sozlash uchun quyidagi bosqichlarni bajaring:

### 1. Repositoryni klonlash
```bash
git clone https://github.com/your-repo-name/jaloladdinmusikalari.git
cd jaloladdinmusikalari
```

### 2. Bog‘liqliklarni o‘rnatish
PHP va Node.js modullarini o‘rnatish uchun quyidagi buyruqlarni bajaring:
```bash
composer install
npm install
npm run dev
```

### 3. Muhit konfiguratsiyasi
`.env.example` faylini `.env` ga nusxalang va kerakli muhit o‘zgaruvchilarini sozlang:
```bash
cp .env.example .env
```

### 4. Ilova kalitini yaratish
Ilova xavfsizligini ta’minlash uchun kalitni yarating:
```bash
php artisan key:generate
```

### 5. Ma'lumotlar bazasini sozlash
- Ma'lumotlar bazasini yarating.
- `.env` faylida ma'lumotlar bazasi uchun kerakli sozlamalarni kiriting:
  ```env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_user
  DB_PASSWORD=your_database_password
  ```

Migratsiyalarni ishga tushirib, kerakli jadval va strukturani yarating:
```bash
php artisan migrate
```

(Ixtiyoriy) Ma'lumotlar bazasini namunaviy ma'lumotlar bilan to‘ldirish:
```bash
php artisan db:seed
```

### 6. Ilovani ishga tushirish
Laravel ilovasini lokal serverda ishga tushirish uchun quyidagi buyruqni bajaring:
```bash
php artisan serve
```

Brauzeringizda ilovani oching: `http://127.0.0.1:8000`.

## Foydali buyruqlar

- `php artisan serve` - Ilovani ishga tushirish.
- `php artisan migrate` - Migratsiyalarni bajarish.
- `php artisan db:seed` - Ma'lumotlar bazasini to‘ldirish.
- `npm run dev` - Frontend resurslarini ishlab chiqish uchun kompilyatsiya qilish.
- `npm run prod` - Frontend resurslarini ishlab chiqarish uchun kompilyatsiya qilish.

## Testlash

Ilovaning to‘g‘ri ishlashini ta’minlash uchun testlarni ishga tushiring:
```bash
php artisan test
```

## Joylashtirish (Deployment)

Laravel ilovasini serverga joylashtirish uchun quyidagi bosqichlarni bajaring:

1. Kodingizni Git repositoryga yuklang.
2. Ishlab chiqarish serverini sozlang (Apache/Nginx, PHP, Composer, Ma'lumotlar bazasi).
3. `.env` faylini ishlab chiqarish muhitiga mos ravishda yangilang.
4. Quyidagi buyruqlarni ishlab chiqarish serverida bajaring:
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
