# LMS API - Learning Management System

API backend untuk platform Learning Management System (LMS) yang dibangun dengan Laravel + MySQL.

## Stack Teknologi

- **Framework:** Laravel 12
- **Database:** MySQL
- **Authentication:** JWT (tymon/jwt-auth)
- **Caching:** Laravel Cache (file-based)
- **Testing:** Postman

---

## Instalasi & Setup

### 1. Clone dan install dependencies

```bash
composer install
```

### 2. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lms_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Install dan setup JWT

```bash
composer require tymon/jwt-auth
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
```

### 4. Jalankan migration

```bash
php artisan migrate
```

### 5. Import database awal

Import file `lms_db.sql` ke MySQL untuk data awal.

### 6. Jalankan server

```bash
php artisan serve
```

Server berjalan di: `http://localhost:8000`

---

## Struktur Database

```
users               → Data user (student, instructor, admin)
product_categories  → Kategori kursus
courses             → Data kursus
enrollments         → Data pendaftaran student ke kursus
```

---

## API Endpoints

### Authentication

| Method | Endpoint         | Akses    | Deskripsi              |
|--------|------------------|----------|------------------------|
| POST   | /api/auth/register | Publik | Registrasi user baru   |
| POST   | /api/auth/login    | Publik | Login & dapatkan token |
| POST   | /api/auth/logout   | Protected | Logout (invalidate token) |
| GET    | /api/auth/me       | Protected | Data user yang login  |

### Categories

| Method | Endpoint                 | Akses    | Deskripsi          |
|--------|--------------------------|----------|--------------------|
| GET    | /api/categories          | Publik   | Semua kategori     |
| GET    | /api/categories/{id}     | Publik   | Detail kategori    |
| POST   | /api/categories          | Publik   | Tambah kategori    |
| PUT    | /api/categories/{id}     | Publik   | Update kategori    |
| DELETE | /api/categories/{id}     | Publik   | Hapus kategori     |

### Courses

| Method | Endpoint             | Akses     | Deskripsi         |
|--------|----------------------|-----------|-------------------|
| GET    | /api/courses         | Publik    | Semua kursus *(cached 60s)* |
| GET    | /api/courses/{id}    | Publik    | Detail kursus     |
| POST   | /api/courses         | 🔒 Token | Tambah kursus     |
| PUT    | /api/courses/{id}    | 🔒 Token | Update kursus     |
| DELETE | /api/courses/{id}    | 🔒 Token | Hapus kursus      |

**Query params GET /api/courses:**
- `?search=react` → Filter berdasarkan nama kursus
- `?id_category=1` → Filter berdasarkan kategori

### Advanced Query

| Method | Endpoint                        | Deskripsi                                    |
|--------|---------------------------------|----------------------------------------------|
| GET    | /api/instructors/course-count   | Jumlah kursus per instructor (Aggregation)   |
| GET    | /api/enrollments/detail         | Detail enrollment JOIN 4 tabel               |

---

## Cara Menggunakan Token (Authentication)

1. Login via `POST /api/auth/login`
2. Salin `token` dari response
3. Tambahkan ke header setiap request protected:
   ```
   Authorization: Bearer <token_kamu>
   ```

---

## Format Response

### Success
```json
{
  "status": "success",
  "message": "Pesan sukses",
  "data": { ... }
}
```

### Error
```json
{
  "status": "error",
  "message": "Deskripsi error"
}
```

### Validation Error (400)
```json
{
  "status": "error",
  "message": "Validasi gagal",
  "errors": {
    "field": ["pesan error validasi"]
  }
}
```

---

## Error Codes

| Code | Arti                                              |
|------|---------------------------------------------------|
| 400  | Bad Request - Input tidak valid                   |
| 401  | Unauthorized - Token tidak ada / tidak valid      |
| 404  | Not Found - Data atau endpoint tidak ditemukan    |
| 405  | Method Not Allowed                                |
| 500  | Internal Server Error                             |

---

## Caching

- Endpoint `GET /api/courses` menggunakan caching dengan TTL **60 detik**
- Cache otomatis dihapus (flush) saat ada operasi `POST`, `PUT`, atau `DELETE` pada courses
- Menggunakan Laravel Cache dengan driver `file` (default)

---

## Contoh Request

### Register
```bash
POST /api/auth/register
Content-Type: application/json

{
  "full_name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "role": "student"
}
```

### Login
```bash
POST /api/auth/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

### Buat Course (butuh token)
```bash
POST /api/courses
Authorization: Bearer <token>
Content-Type: application/json

{
  "course_name": "Laravel Mastery",
  "description": "Belajar Laravel dari nol",
  "price": 300000,
  "quota": 30,
  "id_category": 1,
  "id_instructor": 1
}
```