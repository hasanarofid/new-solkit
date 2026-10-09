# STANDAR PENGEMBANGAN SISTEM SOLKIT TECH
**Modern Software House & Digital Solutions Platform**

Dokumen ini adalah pedoman baku dan standar operasional pengembangan (SOP) software engineering untuk repositori **Solkit Tech**. Seluruh developer dan AI coding assistant wajib mematuhi aturan ini secara konsisten.

---

## 1. Arsitektur & Teknologi Stack

### 1.1 Core Stack
- **Backend**: Laravel 11.x (PHP 8.2+)
- **Frontend**: Vue 3 (Composition API `<script setup>`), Inertia.js 1.x
- **Styling**: Tailwind CSS 3.x + Dynamic CSS Variables untuk custom theming
- **Database**: MySQL 8.x / MariaDB
- **State & Data Sharing**: Inertia Props, Pinia (jika state global frontend diperlukan)
- **Icons**: Lucide Vue Next (`@lucide/vue`)

### 1.2 Filosofi Arsitektur: Monolith Modern (Hybrid Decoupled)
- Frontend dan backend berada dalam satu repositori (*Single Source of Truth*), memanfaatkan keunggulan SSR-like routing tanpa overhead REST API terpisah berkat **Inertia.js**.
- Tidak menggunakan render HTML Blade usang untuk halaman aplikasi; seluruh antarmuka interaktif dirender via komponen Vue 3.
- Konfigurasi tampilan dinamis (warna tema, logo, kontak) diatur melalui tabel `settings` dan diinjeksikan secara real-time via CSS variables di root (`:root { --primary-color: #... }`).

---

## 2. Standar Kualitas & Penulisan Kode

### 2.1 Backend (PHP / Laravel)
1. **Strict Typing & Return Types**:
   - Selalu sertakan tipe data parameter dan return type pada setiap fungsi/method:
     ```php
     public function show(Portfolio $portfolio): Response
     ```
2. **Form Request untuk Validasi**:
   - Dilarang keras menulis logika validasi panjang di dalam Controller.
   - Gunakan `app/Http/Requests/*` (misal: `StorePortfolioRequest`, `UpdateSettingRequest`).
3. **Controller Ramping (Skinny Controllers)**:
   - Controller hanya bertugas menerima HTTP request, memanggil Query/Service, dan mengembalikan response (`Inertia::render()` atau redirect).
4. **Model Mass Assignment & Relationships**:
   - Tentukan `$fillable` secara eksplisit pada setiap Model.
   - Gunakan relasi Eloquent yang rapi (`hasMany`, `belongsTo`, `casts` untuk kolom JSON).
5. **Database Migration & Seeders**:
   - Setiap tabel baru wajib memiliki migration terstruktur lengkap dengan index & foreign key constraints (`onDelete('cascade')` atau `onDelete('set null')`).
   - Wajib menyertakan seeder dummy berkualitas tinggi dengan konten realistis untuk memudahkan testing.

### 2.2 Frontend (Vue 3 + Inertia)
1. **Composition API Only**:
   - Wajib menggunakan `<script setup>` syntax.
   - Hindari Options API (`data()`, `methods`).
2. **UI/UX Pro Max Standard**:
   - Terapkan estetika modern tech-forward: tipografi tebal, kontras tinggi, ruang kosong (*whitespace*) yang lapang, aksen glassmorphism subtle (`backdrop-blur-md`), serta micro-interactions pada hover/focus.
   - Hindari warna mentah primer generic (seperti `#ff0000` atau `#0000ff`). Gunakan kurasi warna modern (Slate, Indigo, Cyan, Emerald).
   - Seluruh komponen harus responsif penuh (*Mobile-First* hingga *Desktop 4K*).
3. **Props Handling & Inertia Form**:
   - Gunakan `useForm()` dari `@inertiajs/vue3` untuk penanganan form submit, validasi error state, dan upload file.
   - Selalu manfaatkan helper inertia seperti `preserveScroll: true` dan flash messages (`usePage().props.flash`).

---

## 3. Desain Layanan Digital Software House Modern

Untuk membedakan Solkit dari CMS konvensional yang kaku dan usang:
1. **Value Proposition Berbasis Dampak (Impact-Driven)**:
   - Portofolio bukan sekadar galeri gambar; wajib menyajikan struktur: **Problem**, **Solution**, **Tech Stack**, dan **Business Impact** (metrik kuantitatif seperti: "+200% efisiensi operasional", "10k+ active users").
2. **Struktur Modul Utama**:
   - **Services / Solutions**: Menampilkan layanan spesifik (Custom Web & SaaS, Mobile Apps, AI Integration, Cloud DevOps, Product Design) lengkap dengan tech stack dan fitur deliverables.
   - **Tech Stack Showcase**: Memamerkan kapabilitas teknologi modern yang dikuasai tim.
   - **Interactive Consultation & Leads**: Form konsultasi interaktif yang otomatis mengarahkan ke pesan WhatsApp berstruktur atau tersimpan di database leads.
   - **Dynamic Theming CMS**: Kemampuan mengubah Primary Color, Nama Brand, dan Logo langsung dari Admin Dashboard tanpa rebuild aplikasi.

---

## 4. Keamanan & Performa

1. **Keamanan (Security)**:
   - Semua input admin dan publik wajib disanitasi dan divalidasi.
   - File upload (gambar thumbnail, logo) harus dibatasi tipe MIME (`image/jpeg,image/png,image/webp`) dan ukuran maksimum (maks 2MB).
   - Lindungi route sensitif dengan middleware `auth`, `verified`, dan role-based access control (Spatie Permission).
2. **Performa**:
   - Gunakan eager loading (`with(['sections', 'services'])`) pada Eloquent query untuk menghindari masalah N+1 query.
   - Optimasi asset build dengan Vite (`npm run build`).

---

## 5. Workflow Git & Deployment

1. **Remote Repository**:
   - Origin resmi: `git@github.com:hasanarofid/new-solkit.git`
2. **Branching Strategy**:
   - `main` / `master`: Production ready code.
   - `feature/<nama-fitur>`: Pengembangan fitur spesifik sebelum di-merge.
3. **Standar Commit Message (Conventional Commits)**:
   - `feat: <deskripsi fitur baru>`
   - `fix: <deskripsi perbaikan bug>`
   - `refactor: <perapian struktur kode>`
   - `docs: <pembaruan dokumentasi>`
   - `chore: <pembaruan dependency/config>`
