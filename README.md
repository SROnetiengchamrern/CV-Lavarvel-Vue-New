# Tieng Chamrern — Online CV

Laravel 12 + Vue 3 curriculum vitae with a full admin panel for every standard CV section.

## Stack

- **Backend:** Laravel 12 (PHP 8.2)
- **Database:** MySQL (`chamrern_cv`)
- **Frontend:** Vue 3 + Vite
- **Admin:** Session auth + CRUD for all CV sections

## Setup (XAMPP MySQL)

1. Start **Apache** and **MySQL** in XAMPP.
2. Create DB (already done if you followed the agent setup):

```sql
CREATE DATABASE IF NOT EXISTS chamrern_cv CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. Install & run:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

### `.env` database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chamrern_cv
DB_USERNAME=root
DB_PASSWORD=
```

## URLs

- Public CV: http://127.0.0.1:8000
- Cover Letter: http://127.0.0.1:8000/cover-letter
- Admin: http://127.0.0.1:8000/admin/login
- Switch language: http://127.0.0.1:8000/lang/km or `/lang/en` (also EN / ខ្មែរ buttons on the public pages)

### Bilingual (English + Khmer)

Admin forms accept **English** and **ខ្មែរ** for profile, CV sections, and cover letter. On the public site, choose **ខ្មែរ** to show Khmer content (falls back to English if a Khmer field is empty).

### Admin login

- Email: `admin@chamrern.cv`
- Password: `password`

## CV templates (5)

Set favorite in **Admin → CV Templates**, or preview:

| Key | Name |
|-----|------|
| `classic` | Classic Navy |
| `emerald` | Emerald Gold |
| `horizon` | Horizon Banner |
| `minimal` | Minimal Blue |
| `mirror` | Mirror Slate |

Preview: `http://127.0.0.1:8000/?layout=horizon`

## Admin sections (standard CV)

| Menu | What you edit |
|------|----------------|
| Personal & Contact | Name, title, photo, phones, personal data (EN + KM), **favorite layout** |
| CV PDF File | Upload PDF for the public **Download CV** button |
| Skills | Add / edit / delete skills & levels |
| Languages | Add / edit / delete languages (0–10) |
| Education | Schools & degrees |
| Work Experience | Jobs + bullet highlights |
| Other Training | Certificates / courses |
| Special Interests | Hobbies |
| References | People & phone numbers |

## Profile photo

Upload in **Admin → Personal & Contact**, or place a file at `public/images/profile.jpg`.

## View uploaded PDF / images

Files are served by Laravel at:

```
http://127.0.0.1:8000/media/certificates/degrees/your-file.pdf
```

Use `php artisan serve` (port 8000). Do **not** open `http://localhost/storage/...` on Apache port 80 — that causes 404.

If links break after moving the project:

```bash
php artisan storage:link
php artisan config:clear
```
