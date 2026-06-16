# ELD Solutions Ltd — Installation & Setup Guide

## Tech Stack
Laravel 13 · Bootstrap 5 · Custom CSS · Vanilla JS · MySQL · PHP 8.3+

---

## Prerequisites
- XAMPP with PHP 8.3+, MySQL, Apache
- Composer
- Node.js 18+

---

## Step-by-Step Setup

### 1. Configure Environment

```bash
cp .env.example .env
```

Edit `.env` and fill in:

```env
APP_URL=http://localhost/eldsolutions/public

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eldsolutions
DB_USERNAME=root
DB_PASSWORD=          # leave blank for XAMPP default

# SMTP Mail (example: Gmail App Password)
MAIL_MAILER=smtp
MAIL_SCHEME=ssl
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_16_char_app_password
MAIL_FROM_ADDRESS="info@eldsolutions.com"
MAIL_FROM_NAME="ELD Solutions Ltd"

# Admin credentials for the initial seeded admin user
ADMIN_NAME="ELD Admin"
ADMIN_EMAIL="admin@eldsolutions.com"
ADMIN_PASSWORD="YourSecurePassword123!"
```

### 2. Create MySQL Database

Open phpMyAdmin (http://localhost/phpmyadmin) and create a database named `eldsolutions`.

Or via CLI:
```bash
mysql -u root -e "CREATE DATABASE eldsolutions CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 3. Install PHP Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Seed the Database

```bash
php artisan db:seed
```

This creates:
- Admin user (credentials from ADMIN_* env vars)
- Empty setting keys (fill in Admin → Settings)

### 7. Link Storage for File Uploads

```bash
php artisan storage:link
```

This creates `public/storage` symlink so uploaded images are publicly accessible.

### 8. Install & Build Frontend Assets

```bash
npm install
npm run build
```

### 9. Set Permissions (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

---

## Accessing the Application

| URL | Description |
|-----|-------------|
| `http://localhost/eldsolutions/public` | Public website |
| `http://localhost/eldsolutions/public/admin` | Admin CMS |

**Default admin login:**
- Email: `admin@eldsolutions.com`
- Password: whatever you set in `ADMIN_PASSWORD`

> ⚠️ Change the admin password immediately after first login via your database or by re-seeding with a strong password.

---

## Mail Configuration Options

### Gmail (Recommended for testing)
1. Enable 2FA on your Google account
2. Generate an App Password: Google Account → Security → App Passwords
3. Use those credentials in `.env`

### Mailgun (Recommended for production)
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=mg.yourdomain.com
MAILGUN_SECRET=key-xxxxxxxxxxxxxxxx
```

### Brevo / Sendinblue
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your_smtp_key
```

---

## Admin CMS Features

| Section | What you can manage |
|---------|---------------------|
| Hero | Heading, subheading, CTA buttons, background image |
| About | Company description, mission statement |
| Services | Title, description, icon (Bootstrap Icons), badge labels |
| Team | Name, position, bio, photo, social links |
| Clients | Logo image or text, website URL |
| Messages | View & reply to contact form submissions |
| Settings | Phone, email, address, social links, admin email |

---

## Production Checklist

- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Set `APP_ENV=production`
- [ ] Configure real SMTP credentials
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set strong `ADMIN_PASSWORD`
- [ ] Configure HTTPS on your server
- [ ] Set correct `APP_URL`
