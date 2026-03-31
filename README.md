# Training Management System (TMS)

## Local Setup (XAMPP)
```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

**Test Accounts:**
- Admin: admin@tms.com / password123
- Trainer: trainer1@tms.com / password123
- Trainee: trainee1@tms.com / password123

## Production Deploy (Railway)
1. Push to Railway
2. **Critical Env Vars:**
   ```
   SESSION_DRIVER=cookie
   APP_URL=https://your-app.railway.app
   CLOUDINARY_URL=cloudinary://key:secret@name (optional - local fallback works)
   ```
3. Auto: migrate, storage:link, cache

## Test Download Flow
1. Trainer uploads material (Cloudinary or local fallback)
2. Admin approves (pending → approved)
3. Trainee enrolls → downloads ✓

## Debug 401 Download
```
tail -f storage/logs/laravel.log
# Look for 'Download attempt' logs
```

Built with Laravel 11 🚀
