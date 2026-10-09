# PRODUCT REQUIREMENT DOCUMENT (PRD)
## SOLKIT TECH - MODERN DIGITAL AGENCY & SOFTWARE HOUSE PLATFORM

---

## 1. Executive Summary
**Solkit Tech** adalah platform web modern untuk sebuah Software House / Digital Solutions Studio yang berfokus pada transformasi digital, pembuatan custom software, SaaS, aplikasi mobile, dan integrasi Artificial Intelligence (AI). 

Platform ini dibangun dengan arsitektur **Laravel 11 (Backend)** dan **Vue 3 + Inertia.js (Frontend)** dengan styling **Tailwind CSS**. Sistem ini menggabungkan fleksibilitas Dynamic CMS dengan kebutuhan presentasi bisnis kelas enterprise, memberikan pengalaman interaktif (*UI/UX Pro Max*) kepada calon klien serta kemudahan pengelolaan konten bagi tim internal.

---

## 2. Core Value Proposition & Diferensiasi
Berbeda dari website software house lama yang hanya berupa blog statis atau portofolio screenshot tanpa konteks:
1. **Impact-Driven Case Studies**: Menampilkan portofolio berdasarkan metrik hasil nyata (*Problem -> Solution -> Tech Stack -> Business Impact*).
2. **Dynamic Corporate Identity**: Admin dapat mengubah warna primer (*Primary Color*), logo, nomor WhatsApp konsultasi, dan nama brand yang otomatis tercermin secara real-time via CSS Variables di root browser.
3. **Structured Service Catalog**: Katalog layanan terperinci mencakup fitur deliverables, tech stack yang digunakan, dan estimasi waktu/proses.
4. **Instant Conversion Channel**: Integrasi form konsultasi & direct WhatsApp lead generator dengan pesan templated otomatis.

---

## 3. Skema & Arsitektur Database MySQL

### 3.1 Tabel `settings`
Menyimpan konfigurasi global sistem:
```sql
CREATE TABLE `settings` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(255) UNIQUE NOT NULL,
  `value` TEXT NULL,
  `type` VARCHAR(50) NOT NULL DEFAULT 'text', -- 'text', 'image', 'color', 'json'
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
);
```
*Key bawaan: `site_name`, `site_tagline`, `primary_color`, `site_logo`, `whatsapp_number`, `contact_email`, `company_address`.*

### 3.2 Tabel `pages` & `sections`
Mengatur dynamic layout & susunan konten landing page:
```sql
CREATE TABLE `pages` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) UNIQUE NOT NULL,
  `meta_description` TEXT NULL,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
);

CREATE TABLE `sections` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `page_id` BIGINT UNSIGNED NOT NULL,
  `key` VARCHAR(255) NOT NULL, -- 'hero', 'tech_stack', 'services', 'portfolios', 'workflow', 'testimonials', 'cta'
  `title` VARCHAR(255) NULL,
  `content` JSON NULL,
  `order` INT DEFAULT 0,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`) ON DELETE CASCADE
);
```

### 3.3 Tabel `services`
Menyimpan katalog layanan software house:
```sql
CREATE TABLE `services` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) UNIQUE NOT NULL,
  `tagline` VARCHAR(255) NULL,
  `description` TEXT NOT NULL,
  `icon` VARCHAR(100) DEFAULT 'Code',
  `features` JSON NULL, -- Array string fitur utama
  `tech_stack` JSON NULL, -- Array badge teknologi
  `order` INT DEFAULT 0,
  `is_active` BOOLEAN DEFAULT TRUE,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
);
```

### 3.4 Tabel `portfolios`
Menyimpan studi kasus dan hasil karya software house:
```sql
CREATE TABLE `portfolios` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) UNIQUE NOT NULL,
  `client_name` VARCHAR(255) NULL,
  `industry` VARCHAR(100) NULL,
  `problem` TEXT NULL,
  `solution` TEXT NULL,
  `impact_metric` VARCHAR(255) NULL, -- Contoh: "+350% Efisiensi Operasional", "50k+ Pengguna Aktif"
  `tech_stack` JSON NULL, -- Array badge teknologi (Laravel, Vue, Flutter, AWS)
  `thumbnail` VARCHAR(255) NULL,
  `project_url` VARCHAR(255) NULL,
  `is_featured` BOOLEAN DEFAULT FALSE,
  `is_active` BOOLEAN DEFAULT TRUE,
  `order` INT DEFAULT 0,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
);
```

### 3.5 Tabel `leads`
Menyimpan inquiries/leads dari calon klien:
```sql
CREATE TABLE `leads` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) NULL,
  `company` VARCHAR(255) NULL,
  `service_interest` VARCHAR(100) NULL,
  `budget_range` VARCHAR(100) NULL,
  `message` TEXT NOT NULL,
  `status` VARCHAR(50) DEFAULT 'new', -- 'new', 'contacted', 'qualified', 'closed'
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
);
```

---

## 4. Spesifikasi Modul Frontend (UI/UX Pro Max)

1. **Header & Navigation**:
   - Sticky Glassmorphism Navbar (`backdrop-blur-md`).
   - Dynamic Brand Logo & Name.
   - Quick CTA: "Konsultasi Project".
2. **Hero Section**:
   - Modern Headline dengan aura gradient halus.
   - Value Proposition: Spesialis pembuatan Custom Web App, Mobile App & AI Solutions untuk skalabilitas bisnis.
   - Dual CTA: "Mulai Konsultasi" (Lead Trigger) & "Lihat Case Studies".
   - Floating Stats / Trust Badges (misal: 99.8% Uptime SLA, 50+ Proyek Sukses, 5+ Tahun Pengalaman).
3. **Tech Stack Showcase**:
   - Interactive badge/logo grid teknologi modern (Laravel 11, Vue 3, React, Next.js, Flutter, Python AI, Docker, AWS, PostgreSQL).
4. **Services Showcase**:
   - Card interaktif dengan icon Lucide, ringkasan deliverables, dan tech tags.
5. **Featured Case Studies (Portofolio)**:
   - Tampilan studi kasus dengan kartu modern: Client, Problem, Solution, Tech Stack tags, dan Impact Metric banner.
6. **Agile Workflow / How We Work**:
   - 4 Langkah Kerja: *1. Discovery & Architecture -> 2. UI/UX Prototyping -> 3. Agile Sprint Development -> 4. Quality Assurance & Launch*.
7. **Client Testimonials & Social Proof**:
   - Review klien terverifikasi dengan nama, jabatan, dan avatar.
8. **Consultation / Lead Modal & Footer**:
   - Form cepat kirim inquiry atau tombol direct WhatsApp dengan template otomatis.

---

## 5. Spesifikasi Modul Admin Panel (CMS)

1. **Dashboard Analytics**: Ringkasan data (Total Services, Portfolios, Dynamic Sections, dan Leads).
2. **Global Settings Manager**: Form edit nama situs, tagline, nomor WhatsApp, email, logo upload, dan **Primary Color Picker** (mengatur warna aksen seluruh website secara dinamis).
3. **Services Management (CRUD)**: Kelola layanan, icon, list fitur, dan tech stack.
4. **Portfolios Management (CRUD)**: Kelola studi kasus klien, upload thumbnail, client info, problem/solution, impact metric, dan tech badges.
5. **Page & Section Manager**: Atur status aktif/non-aktif dan urutan seksi di landing page.
