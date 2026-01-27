# دليل المطور - إعداد وتشغيل النظام (Developer Setup Guide)

## جدول المحتويات
1. [نظرة عامة](#نظرة-عامة)
2. [متطلبات النظام](#متطلبات-النظام)
3. [التثبيت الأولي](#التثبيت-الأولي)
4. [إعداد قاعدة البيانات](#إعداد-قاعدة-البيانات)
5. [إعداد البيئة](#إعداد-البيئة)
6. [تشغيل النظام](#تشغيل-النظام)
7. [هيكل المشروع](#هيكل-المشروع)
8. [الأدوات والتقنيات](#الأدوات-والتقنيات)
9. [أوامر Artisan المفيدة](#أوامر-artisan-المفيدة)
10. [إعدادات التطوير](#إعدادات-التطوير)
11. [استكشاف الأخطاء](#استكشاف-الأخطاء)
12. [نصائح للتطوير](#نصائح-للتطوير)

---

## نظرة عامة

**MASSAR ERP** هو نظام إدارة موارد المؤسسات (ERP) متكامل مبني على Laravel 12 مع Livewire 3 وبنية معيارية (Modular Architecture).

### المميزات الرئيسية:
- **Laravel 12**: أحدث إصدار من Laravel
- **Livewire 3**: واجهة تفاعلية بدون الحاجة لكتابة JavaScript
- **Livewire Volt**: مكونات وظيفية بسيطة
- **Modular Structure**: بنية معيارية باستخدام `nwidart/laravel-modules`
- **Permission System**: نظام صلاحيات متقدم باستخدام Spatie Permission
- **Queue System**: نظام قوائم للعمليات الثقيلة
- **Real-time**: دعم WebSockets عبر Laravel Reverb

---

## متطلبات النظام

### متطلبات الخادم
- **PHP**: `^8.2` أو أحدث
- **Composer**: `^2.0`
- **Node.js**: `^18.0` أو أحدث
- **NPM**: `^9.0` أو أحدث
- **MySQL**: `^8.0` أو `MariaDB ^10.3`
- **Redis**: `^6.0` (اختياري - للـ Cache و Queue)

### ملحقات PHP المطلوبة
```bash
php -m | grep -E "pdo_mysql|mbstring|xml|curl|zip|gd|intl|bcmath|openssl"
```

**الملحقات المطلوبة:**
- `pdo_mysql` - للاتصال بقاعدة البيانات
- `mbstring` - لمعالجة النصوص متعددة البايت
- `xml` - لمعالجة XML
- `curl` - للطلبات HTTP
- `zip` - لضغط/فك الملفات
- `gd` أو `imagick` - لمعالجة الصور
- `intl` - للدولية
- `bcmath` - للحسابات الدقيقة
- `openssl` - للتشفير

### أدوات التطوير (اختياري)
- **Git**: لإدارة الإصدارات
- **VS Code** أو **PhpStorm**: محرر الكود
- **MySQL Workbench** أو **phpMyAdmin**: لإدارة قاعدة البيانات
- **Postman** أو **Insomnia**: لاختبار API

---

## التثبيت الأولي

### الخطوة 1: استنساخ المشروع
```bash
## بعد تنزيل البرنامج من الرابط

cd mada-erp

# أو إذا كان المشروع موجوداً، انتقل للمجلد
cd mada-erp
```

### الخطوة 2: تثبيت Dependencies
```bash
# تثبيت PHP Dependencies
composer install

# تثبيت Node.js Dependencies
npm install 
او بيكون متسطب فعلا
```

### الخطوة 3: إعداد ملف البيئة
```bash
# نسخ ملف البيئة
cp .env.example .env

# أو إنشاء ملف .env جديد
touch .env
```

### الخطوة 4: توليد مفتاح التطبيق
```bash
php artisan key:generate
```

### الخطوة 5: إنشاء رابط التخزين
```bash
php artisan storage:link
```

---

## إعداد قاعدة البيانات

### الخطوة 1: إنشاء قاعدة البيانات
```sql
-- في MySQL
CREATE DATABASE mada_erp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

أو باستخدام MySQL Command Line:
```bash
mysql -u root -p -e "CREATE DATABASE mada_erp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### الخطوة 2: إعداد ملف .env
افتح ملف `.env` وعدّل إعدادات قاعدة البيانات:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mada_erp
DB_USERNAME=root
DB_PASSWORD=your_password
```

### الخطوة 3: تشغيل Migrations
```bash

# أو مع Seeders
php artisan migrate:fresh --seed
```

### الخطوة 4: تشغيل Seeders (اختياري)
```bash
# تشغيل جميع Seeders
php artisan db:seed

# أو تشغيل Seeder محدد
php artisan db:seed --class=UserSeeder
```

### إعادة تعيين قاعدة البيانات (Development)
```bash

# أو استخدام الأمر الآمن (يحفظ البيانات)
php artisan db:fresh-safe --seed
```

---

## إعداد البيئة

### ملف .env الأساسي
```env
APP_NAME="MASSAR ERP"
APP_ENV=local
APP_KEY=base64:...    ## must be genrated
APP_DEBUG=true         /(false)
APP_TIMEZONE=UTC
APP_URL=http://localhost:8000
APP_LOCALE=ar
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=ar_SA

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mada_erp
DB_USERNAME=root
DB_PASSWORD=

# Cache & Queue
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file

# Mail (اختياري)
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Redis (اختياري)
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Broadcasting (اختياري)
BROADCAST_DRIVER=reverb
REVERB_APP_ID=massar-erp
REVERB_APP_KEY=app-key
REVERB_APP_SECRET=app-secret
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
```

### إعدادات إضافية للتطوير
```env
# Debug
APP_DEBUG=true
LOG_LEVEL=debug

# Performance
DEBUGBAR_ENABLED=true

# Development Tools
TELESCOPE_ENABLED=false
```

---

## تشغيل النظام

### الطريقة 1: تشغيل يدوي (Manual)
```bash
# Terminal 1: تشغيل الخادم
php artisan serve

# Terminal 2: تشغيل Vite (للتطوير)
npm run dev

# Terminal 3: تشغيل Queue Worker (إذا كان Queue مفعّل)
php artisan queue:work
```

### الطريقة 2: تشغيل متزامن (Concurrent)
```bash
# تشغيل كل شيء معاً (Server + Queue + Vite)
composer dev
```

هذا الأمر يشغل:
- **Server**: `php artisan serve` على المنفذ 8000
- **Queue**: `php artisan queue:listen`
- **Vite**: `npm run dev` للموارد

### الوصول للنظام
افتح المتصفح على:
```
http://localhost:8000
```

### بيانات الدخول الافتراضية
بعد تشغيل Seeders، يمكنك استخدام:
- **Email**: `admin@example.com` (أو حسب ما في UserSeeder)
- **Password**: `password` (أو حسب ما في UserSeeder)

---

## هيكل المشروع

### البنية الأساسية
```
mada-erp/
├── app/                    # الكود الأساسي للتطبيق
│   ├── Console/           # Artisan Commands
│   ├── Enums/             # Enumerations
│   ├── Helpers/           # Helper Functions
│   ├── Http/              # Controllers, Middleware, Requests
│   ├── Jobs/              # Queue Jobs
│   ├── Listeners/         # Event Listeners
│   ├── Livewire/          # Livewire Components
│   ├── Models/            # Eloquent Models
│   ├── Observers/         # Model Observers
│   ├── Providers/         # Service Providers
│   ├── Services/          # Business Logic Services
│   └── Support/           # Support Classes
│
├── Modules/               # الوحدات المعيارية
│   ├── Accounts/         # وحدة الحسابات
│   ├── Invoices/         # وحدة الفواتير
│   ├── HR/               # وحدة الموارد البشرية
│   ├── CRM/              # وحدة إدارة علاقات العملاء
│   ├── POS/              # وحدة نقاط البيع
│   └── ...               # وحدات أخرى
│
├── database/              # قاعدة البيانات
│   ├── factories/         # Model Factories
│   ├── migrations/       # Database Migrations
│   └── seeders/          # Database Seeders
│
├── resources/             # الموارد
│   ├── css/              # ملفات CSS
│   ├── js/               # ملفات JavaScript
│   ├── lang/             # ملفات الترجمة
│   └── views/            # Blade Templates
│
├── routes/                # Routes
│   ├── web.php           # Web Routes
│   ├── api.php           # API Routes
│   └── modules/         # Module Routes
│
├── public/                # الملفات العامة
│   ├── index.php         # نقطة الدخول
│   └── assets/           # الأصول المترجمة
│
├── storage/               # التخزين
│   ├── app/              # ملفات التطبيق
│   ├── logs/             # ملفات السجلات
│   └── framework/        # ملفات الإطار
│
├── tests/                 # الاختبارات
│   ├── Feature/          # Feature Tests
│   └── Unit/             # Unit Tests
│
├── config/                # ملفات الإعدادات
├── bootstrap/             # ملفات التهيئة
├── vendor/                # Dependencies (Composer)
├── node_modules/          # Dependencies (NPM)
│
├── composer.json          # PHP Dependencies
├── package.json           # Node.js Dependencies
├── vite.config.js         # إعدادات Vite
└── phpunit.xml            # إعدادات PHPUnit
```

### هيكل الوحدة (Module Structure)
```
Modules/ModuleName/
├── Config/                # إعدادات الوحدة
├── Console/              # Commands خاصة بالوحدة
├── Database/
│   ├── Migrations/        # Migrations
│   └── Seeders/          # Seeders
├── Http/
│   ├── Controllers/      # Controllers
│   ├── Middleware/       # Middleware
│   └── Requests/        # Form Requests
├── Livewire/             # Livewire Components
├── Models/                # Models
├── Providers/             # Service Providers
├── Resources/
│   ├── assets/           # Assets (JS/CSS)
│   ├── lang/             # Translations
│   └── views/            # Blade Views
├── Routes/
│   ├── web.php           # Web Routes
│   └── api.php           # API Routes
└── module.json            # معلومات الوحدة
```

---

## الأدوات والتقنيات

### Backend
- **Laravel 12**: إطار العمل الرئيسي
- **Livewire 3**: واجهة تفاعلية
- **Livewire Volt**: مكونات وظيفية
- **Spatie Permission**: إدارة الصلاحيات
- **Spatie Media Library**: إدارة الملفات
- **Spatie Activity Log**: سجل الأنشطة
- **Laravel Sanctum**: API Authentication
- **Laravel Reverb**: WebSockets
- **Laravel Queue**: معالجة المهام في الخلفية

### Frontend
- **Alpine.js**: JavaScript Framework (مدمج مع Livewire)
- **Bootstrap 5**: CSS Framework
- **Tailwind CSS 4**: Utility-first CSS
- **Vite**: Build Tool
- **Axios**: HTTP Client

### Database
- **MySQL/MariaDB**: قاعدة البيانات الرئيسية
- **Eloquent ORM**: ORM لـ Laravel

### Development Tools
- **Laravel Debugbar**: Debug Toolbar
- **Laravel IDE Helper**: IDE Support
- **Laravel Pint**: Code Style Fixer
- **PHPUnit**: Testing Framework
- **Laravel Pail**: Log Viewer

### Packages المهمة
- **nwidart/laravel-modules**: Modular Structure
- **mhmiton/laravel-modules-livewire**: Livewire في Modules
- **maatwebsite/excel**: Excel Import/Export
- **barryvdh/laravel-dompdf**: PDF Generation
- **realrashid/sweet-alert**: Alert Notifications
- **salla/zatca**: ZATCA Integration (السعودية)

---

## أوامر Artisan المفيدة

### Cache & Config
```bash
# مسح Cache
# مسح كل شيء
php artisan optimize:clear
```

### Modules
```bash


## استكشاف الأخطاء

### مشكلة: خطأ في الاتصال بقاعدة البيانات
```bash
# التحقق من إعدادات .env
cat .env | grep DB_

# اختبار الاتصال
php artisan tinker
>>> DB::connection()->getPdo();
```
_____________________________________________
############# DEVOLOPER CRITICAL CASES ################
### مشكلة: خطأ في Permissions
```bash
# إصلاح Permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### مشكلة: خطأ في Composer
```bash
# مسح Cache وإعادة التثبيت
composer clear-cache
rm -rf vendor composer.lock
composer install
```

### مشكلة: خطأ في NPM
```bash
# مسح Cache وإعادة التثبيت
rm -rf node_modules package-lock.json
npm cache clean --force
npm install
```

### مشكلة: خطأ في Vite
```bash
# إعادة بناء Assets
npm run build

# أو للتطوير
npm run dev
```

### مشكلة: خطأ في Queue
```bash
# التحقق من إعدادات Queue
php artisan queue:work --verbose

# إعادة محاولة Jobs الفاشلة
php artisan queue:retry all
```

### مشكلة: خطأ في الصلاحيات (Permissions)
```bash
# التحقق من الصلاحيات
php artisan permission:cache-reset

# إعادة توليد الصلاحيات
php artisan db:seed --class=RoleAndPermissionDatabaseSeeder
```

### مشكلة: خطأ في Module
```bash
# إعادة اكتشاف Modules
php artisan module:optimize

# أو مسح Cache
php artisan optimize:clear
```

### عرض Logs
```bash
# عرض آخر Logs
tail -f storage/logs/laravel.log

# أو باستخدام Pail
php artisan pail
```

---

## نصائح للتطوير

### 1. استخدام Git بشكل صحيح
```bash
# إنشاء Branch جديد
git checkout -b feature/feature-name

# Commit Changes
git add .
git commit -m "feat: add new feature"

# Push
git push origin feature/feature-name
```

### 2. اتباع معايير الكود
- استخدم **Laravel Pint** لضمان اتساق الكود
- اتبع **PSR-12** Coding Standards
- استخدم **PHPDoc** للتوثيق

### 3. كتابة Tests
```bash
# إنشاء Test
php artisan make:test ExampleTest

# تشغيل Tests
php artisan test
```

### 4. استخدام Debugging Tools
- **Laravel Debugbar**: لفحص Queries و Performance
- **Laravel Tinker**: لاختبار الكود مباشرة
- **Laravel Pail**: لعرض Logs في الوقت الفعلي

### 5. تحسين الأداء
```bash
# Cache Configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize Autoloader
composer dump-autoload -o
```

### 6. العمل مع Modules
- كل Module مستقل بذاته
- استخدم `php artisan module:make-*` لإنشاء الملفات
- تأكد من تشغيل Migrations لكل Module

### 7. إدارة الصلاحيات
- استخدم **Spatie Permission** لإدارة الصلاحيات
- كل صلاحية تتبع نمط: `{action} {resource}`
- مثال: `create invoice`, `view invoice`, `edit invoice`

### 8. العمل مع Livewire
- استخدم **Livewire Volt** للمكونات البسيطة
- استخدم **Full Livewire Components** للمكونات المعقدة
- تجنب استخدام JavaScript مباشرة قدر الإمكان

### 9. إدارة Assets
- استخدم **Vite** لبناء Assets
- استخدم `@vite()` في Blade Templates
- لا تعدّل ملفات في `public/assets` مباشرة

### 10. قاعدة البيانات
- استخدم **Migrations** لتغيير قاعدة البيانات
- استخدم **Seeders** للبيانات الأولية
- استخدم **Factories** للبيانات التجريبية

---

## سير العمل (Workflow) الموصى به

### 1. البدء بمشروع جديد
```bash
# 1. استنساخ المشروع
git clone <repo> mada-erp
cd mada-erp

# 2. تثبيت Dependencies
composer install
npm install

# 3. إعداد البيئة
cp .env.example .env
php artisan key:generate

# 4. إعداد قاعدة البيانات
# عدّل .env ثم:
php artisan migrate --seed

# 5. تشغيل النظام
composer dev
```

### 2. العمل على Feature جديد
```bash
# 1. إنشاء Branch
git checkout -b feature/new-feature

# 2. إنشاء Module (إذا لزم الأمر)
php artisan module:make NewModule

# 3. تطوير Feature
# ... كتابة الكود ...

# 4. اختبار
php artisan test

# 5. Commit
git add .
git commit -m "feat: add new feature"

# 6. Push
git push origin feature/new-feature
```

### 3. إصلاح Bug
```bash
# 1. إنشاء Branch
git checkout -b fix/bug-name

# 2. إصلاح Bug
# ... إصلاح الكود ...

# 3. اختبار
php artisan test

# 4. Commit
git add .
git commit -m "fix: fix bug description"

# 5. Push
git push origin fix/bug-name
```

---



## الدعم والمساعدة

### في حالة وجود مشاكل:
1. راجع قسم [استكشاف الأخطاء](#استكشاف-الأخطاء)
2. راجع ملفات Logs في `storage/logs/`
3. استخدم `php artisan tinker` لاختبار الكود
4. راجع التوثيق الرسمي
5. اتصل بفريق التطوير

## CORE TEAM ;
مع الشكر من فريق العمل 
SystemArchitecture:AbdelhadeEladawy;
BackEndDevSenior:EssamElkhouly;
BackEndDevSenior:MohammadElagawy;
UiUx&Testing:NorMohammad;
UiUx&Testing:MaryamShalaby:

---

**آخر تحديث:** {{ 2026-01-01 }}
**الإصدار:** 1.0