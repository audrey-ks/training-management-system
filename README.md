# ECA CONSEILS
## Built with Laravel 12 + PHP 8.2 + MySQL

---

## 📁 Project Structure

tms/
├── app/
│   ├── Console/Kernel.php
│   ├── Exceptions/Handler.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── UserController.php
│   │   │   │   ├── SessionController.php
│   │   │   │   └── ReportController.php
│   │   │   ├── Trainer/
│   │   │   │   ├── DashboardController.php
│   │   │   │   └── MaterialController.php
│   │   │   └── Trainee/
│   │   │       ├── DashboardController.php
│   │   │       └── SessionViewController.php
│   │   ├── Kernel.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── TrainingSession.php
│   │   ├── SessionMaterial.php
│   │   ├── SessionEnrollment.php
│   │   └── Report.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       ├── AuthServiceProvider.php
│       └── RouteServiceProvider.php
├── bootstrap/app.php
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   ├── filesystems.php
│   └── session.php
├── database/
│   └── tms_database.sql   ← IMPORT THIS INTO PHPMYADMIN
├── public/
│   ├── index.php
│   └── .htaccess
├── resources/views/
│   ├── auth/login.blade.php
│   ├── layouts/app.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── users/{index,create,edit}.blade.php
│   │   ├── sessions/{index,create,edit,show}.blade.php
│   │   └── reports/{index,show}.blade.php
│   ├── trainer/
│   │   ├── dashboard.blade.php
│   │   └── sessions/materials.blade.php
│   └── trainee/
│       ├── dashboard.blade.php
│       └── sessions/{index,show}.blade.php
├── routes/
│   ├── web.php
│   ├── api.php
│   └── console.php
├── storage/
├── .env
└── composer.json
```

---

## 🗄️ Step 1 — Import the Database into phpMyAdmin

1. Open your browser → go to **http://localhost/phpmyadmin**
2. Log in (default: username `root`, password blank or as set)
3. Click **"New"** in the left sidebar to create a new database
4. Name it: `tms_database` → Collation: `utf8mb4_unicode_ci` → click **Create**
5. Click on `tms_database` in the left sidebar
6. Click the **"Import"** tab at the top
7. Click **"Choose File"** → select `database/tms_database.sql`
8. Scroll down → click **"Import"** (green button)
9. ✅ You should see "Import has been successfully finished"

**Note**: After import, optionally run `php artisan migrate` in project root to ensure all tables (incl. media) are synced.

The SQL file creates:
- All 5 tables (users, training_sessions, session_enrollments, session_materials, reports)
- 6 demo users (1 admin, 2 trainers, 3 trainees)
- 3 sample training sessions
- 5 sample enrollments
- 2 helpful views (v_session_summary, v_user_summary)

---

## ⚙️ Step 2 — Configure the .env File

Open the `.env` file in the project root and update:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tms_database
DB_USERNAME=root
DB_PASSWORD=             ← your MySQL root password (blank if none)
```

**For XAMPP:** DB_HOST=127.0.0.1, DB_USERNAME=root, DB_PASSWORD=
**For WAMP:**  Same as XAMPP
**For Laragon:** Same — check Laragon's MySQL settings if different

---

## 🚀 Step 3 — Install & Run

```bash
# 1. Move into project folder
cd tms

# 2. Install PHP dependencies
composer install

# 3. Generate application key
php artisan key:generate

# 4. Create the storage symlink (for file uploads)
php artisan storage:link

# 5. Start the development server
php artisan serve
```

Then open: **http://localhost:8000**

---

## 🔑 Demo Login Accounts

All accounts use the password: **`password`**

| Role    | Email               | Password |
|---------|---------------------|----------|
| Admin   | admin@tms.com       | password |
| Trainer | trainer1@tms.com    | password |
| Trainer | trainer2@tms.com    | password |
| Trainee | trainee1@tms.com    | password |
| Trainee | trainee2@tms.com    | password |
| Trainee | trainee3@tms.com    | password |

---

## 👥 Actor Capabilities

### 🔴 Admin
- Login and access admin dashboard with statistics
- **Manage Users**: Add / Edit / Delete / Activate-Deactivate admins, trainers, trainees
- **Manage Sessions**: Create / Edit / Delete training sessions, assign trainers
- **View Sessions**: See enrolled trainees and uploaded materials per session
- **Reports**: Generate 5 report types (Summary, Users, Sessions, Enrollments, Materials)
- **Delete Reports**: Remove any generated report
- **Email Notifications**: Receive alerts when users login/logout (check mail.log or storage/logs/laravel.log if MAIL_MAILER=log)

### 🟡 Trainer
- Login and see personal dashboard with assigned sessions
- **Upload Materials** to assigned sessions: PDFs, Word, PPT, images, videos, audio, ZIP
- **Delete Materials** they uploaded
- View enrolled trainee count per session

### 🟢 Trainee
- Login and see personal dashboard with enrolled sessions
- **Browse** all available sessions
- **Enroll** in sessions (up to max capacity)
- **View** session details and material list
- **Download** materials from sessions they are enrolled in (locked if not enrolled)

---

## 📤 File Upload Support

Trainers can upload:
- 📄 Documents: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, TXT
- 🖼️ Images: PNG, JPG, JPEG, GIF
- 🎬 Videos: MP4, AVI, MOV
- 🎵 Audio: MP3
- 📦 Archives: ZIP, RAR
**Maximum file size: 100MB**

**Cloud Storage**: Optional Cloudinary support configured (add CLOUDINARY_URL, CLOUDINARY_UPLOAD_PRESET to .env for cloud uploads instead of local).

Uploaded files are stored in: `storage/app/public/sessions/{session_id}/materials/`

---

## 🗃️ Database Tables Overview

| Table                 | Purpose                                    |
|-----------------------|--------------------------------------------|
| `users`               | All users — admin, trainer, trainee        |
| `training_sessions`   | Sessions created by admin                  |
| `session_enrollments` | Trainee ↔ Session enrollment records       |
| `session_materials`   | Files uploaded by trainers per session     |
| `reports`             | Reports generated by admin                 |
| `media`               | Polymorphic media/file metadata            |
| `activity_logs`       | Ready for logging user actions             |

---

## 🔧 Common Issues & Fixes

**Error: "No application encryption key"**
→ Run: `php artisan key:generate`

**Error: "SQLSTATE: Access denied"**
→ Check DB_USERNAME and DB_PASSWORD in `.env`

**Storage uploads not working**
→ Run: `php artisan storage:link`
→ Make sure `storage/app/public/` is writable: `chmod -R 775 storage`

**Blank page / 500 error**
→ Check `storage/logs/laravel.log` for the error message
→ Make sure `APP_DEBUG=true` in `.env` during development

**phpMyAdmin shows "No database selected"**
→ Make sure you clicked on `tms_database` in the left sidebar before importing

**No admin notification emails?**
→ Ensure MAIL_MAILER=log or smtp in .env
→ Login as trainee/trainer, check storage/logs/laravel.log or mail logs
→ Verify events fire in AuthController

---

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **Language**: PHP 8.2+
- **Database**: MySQL 5.7+
- **Frontend**: Bootstrap 5.3 + Font Awesome 6.5
- **Authentication**: Laravel Session-based Auth
- **File Storage**: Laravel Storage (local disk / public)
- **Authorization**: Custom RoleMiddleware (admin / trainer / trainee)
- **Notifications**: Admin email alerts on user login/logout events
- **Cloudinary**: Ready for cloud-based file storage
