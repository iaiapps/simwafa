# Changelog

## 2026-10-16 — Audit konsistensi lintas halaman

### Temuan & fix
- **Card shadow `none`** — Bootstrap `$enable-shadows` default false sehingga
  `--bs-card-box-shadow` didefinisikan tapi `box-shadow` tak di-emit.
  Fix: `box-shadow: var(--sw-shadow-1)` eksplisit di `.card`
  (dropdown/stat-card/modal sudah eksplisit, aman).
- **Radius card 12px vs 20px** — 16 view memakai `class="card rounded …"`;
  utility `rounded` (12px) menimpa `--bs-card-border-radius` (20px).
  Fix: `rounded` dihapus dari semua `card` (radius seragam 20px).
- **Thead tabel transparan di halaman DataTables** — selector
  `table.table.dataTable > :not(caption) > * > *` (spesifisitas 0,2,2)
  menimpa `.table thead th` (0,1,2) dan dataload setelah CSS app.
  Fix: rule `table.dataTable.table thead th` (0,2,3) → bone.
- **Select kecil: arrow menimpa teks** — blanket `padding: .5rem 1rem`
  menimpa padding-arrow `.form-select` Bootstrap.
  Fix: `.form-select { padding-right: 2.25rem; }` + `.dt-length select`
  kompak (h 40px, 0.9375rem) menyamai tinggi search.
- **Filter `/student` tak responsif** — `col-4` tetap → select memadat
  `-- pil` di 390px. Fix: `row g-2` + `col-12 col-md-4` (stack mobile,
  3-kolom ≥md).

### Verifikasi
- Konsistensi shell/token 11 halaman: sidebar 264px bone, header 64px surface,
  canvas `#FDF8F0`, h1 Nunito 30.4px ink, card 20px + shadow-1, input 12px —
  seragam semua.
- Thead bone + tombol semantik (primary/outline-secondary/outline-danger/ghost)
  terkonfirmasi di semua index.
- axe wcag2a+aa: **0 pelanggaran** (12 halaman + mobile `/student`).
- Kontras 10 komposit kunci di `/student`: 5.28–15.19:1 → 0 gagal.
- Mobile 390: tanpa overflow, filter stack, offcanvas OK.

## 2026-10-16 — Review + perbaikan temuan fase 2

### Kritis: rusak oleh penghapusan `<style>` (fase 2)
- 4 file punya `@push@endpush` sisa (glue) → exception `View\Factory::$startPush`
  saat `/assigncluster` & `/movecluster` dibuka. Dihapus:
  `admin/student/assignCluster`, `admin/student/moveGrade`,
  `teacher/assignCluster`, `teacher/evaluation/evalcreate`.

### A11y: label for/id mismatch
- `admin/teacher/edit.blade.php` — 2 label `for="name"` → `for="grade_id"`/`for="cluster_id"`,
  select `id="role"` → unik (duplikat id dihapus).
- `admin/evaluation/create.blade.php` — label `for` sudah benar tapi select `id="siswa"`
  ganda → `id="grade_id"`/`id="komponen_id"`; Select2 JS disinkronkan.
- `admin/student/create.blade.php` — 3 select `id="role"` ganda → `grade_id`/`cluster_id`/`stage_id`
  (label `for` disamakan).
- `admin/student/edit.blade.php` — 2 select `id="role"` ganda → `cluster_id`/`stage_id`.

### A11y: select/checkbox tanpa accessible name
- `aria-label` ditambahkan: filter evaluation index, walas/grade, evalindex,
  evalcreate (`komponen_id`), year create/edit (via label cocok),
  table select teacher/create (`Kelas/Kelompok untuk {nama}`),
  50 checkbox row × 5 file assign/move (`Pilih {nama siswa}`).

### A11y: label & input
- `student/edit` — input disabled "Kelas" → `aria-label="Kelas"`.
- `grade/index` — DataTables KeyTable focus proxy → `aria-label="Sel tabel"`
  via JS setelah init.

### Konsistensi: inline style → SCSS (seksi baru `_components.scss`)
- header chevron (`.header-context i`, `.user-chip > i`)
- login hint (`.login-remember`, `.login-hint`)
- section icon (`.section-title i`)
- eval table (`.td-student-name`)
- Semua `style="..."` di view non-welcome/raportshow kini 0.

### Verifikasi final (22 halaman, axe wcag2a+aa)
- **0 pelanggaran** di 21 halaman: `/`, `/login`, `/student`, `/cluster`,
  `/teacher`, `/evaluation`, `/year`, `/user`, `/grade`, `/jurnal`,
  `/komponen`, `/stage`, `/student/create`, `/student/1/edit`,
  `/teacher/create`, `/evaluation/create`, `/user/create`,
  `/editrole?urole=1`, `/assigngrade`, `/assigncluster`, `/movecluster`.
- `/assignstage` = 404 (route dikomentari di `routes/web.php`, pre-existing).
- `/year/create` & `/komponen/create` = modal-only view (controller return null /
  raw modal HTML, pre-existing — bukan halaman ber-layout).

### Temuan review yang DITINGGALKAN (pre-existing, di luar scope tema)
- `raportshow.blade.php` inline print CSS (60+ baris layout cetak).
- `welcome.blade.php` Tailwind default Laravel.
- DataTables export `className: 'btn btn-primary btn-sm'`.
- Route `assignstage` dikomentari.

---

## 2026-10-16 — Fase 2: sweep semantik tombol + migrasi inline style

### Perubahan massal (sed)
- **Edit** `btn-warning btn-sm` → `btn-outline-secondary btn-sm` + kapitalisasi label (12 file)
- **Delete** `btn-danger btn-sm` → `btn-outline-danger btn-sm` + label `Hapus` (9 file)
- **Detail** `btn-warning btn-sm` → `btn-outline-secondary btn-sm` + label `Detail` (2 file)
- **Submit** `btn-success` → `btn-primary` di semua form create/edit (20 file)

### Perubahan manual
- `admin/student/index.blade.php` — nav `Tentukan Kelas/Kelompok` → `outline-secondary`;
  `Pindahkan Siswa` → `outline-secondary`; `Hapus Siswa` → `outline-danger`;
  `Raport` → `btn-ghost`; fix `select-name` axe (`aria-label` + id unik).
- `admin/teacher/index.blade.php` — `Lihat Kelompok`/`Tentukan Wali Kelas/Kelompok` → `outline-secondary`.
- `admin/journal/index.blade.php` — `Lihat Jurnal` → `btn-ghost`.
- `admin/journal/show.blade.php` — `Kembali` → `outline-secondary`.
- `admin/evaluation/index.blade.php` — multi-line delete → `outline-danger` + label `Hapus`.
- `admin/student/raport/raportshow.blade.php` — hapus `text-white` dari label `btaq`.
- `teacher/home.blade.php` — tile `bg-primary/danger/success + text-white + nav-link`
  (pola rusak) → `action-tile` (sama dengan dashboard admin).
- `teacher/guru/cluster.blade.php` — `Pilih Kelompok` → `outline-secondary`.

### Migrasi inline style → SCSS
- `.my-check` (checkbox seleksi biru hardcoded) → token `--sw-info`
- `.lebar` (kolom input penilaian)
- `.w-name`, `input:focus`, `td.selected` (DataTables keytable)
- Semua dari 5 view; dihapus dari Blade, ditambahkan ke `_components.scss` seksi 20.

### Dibiarkan (di luar scope / risiko tinggi)
- `raportshow.blade.php` inline print CSS (layout cetak raport, 60+ baris)
- `welcome.blade.php` (default Laravel, bukan halaman aplikasi)
- DataTables export `className: 'btn btn-primary btn-sm'` (fungsi ekspor, bukan UI utama)

### Verifikasi
- `npm run build` sukses → `app-14d38fc1.css` 325 kB
- Axe 0 pelanggaran: `/` `/student` `/cluster` `/teacher`
- Kontras 448 elemen di `/student`: 0 gagal
- Route teacher: `/student-cluster` `/student-grade` `/eval-student` → Forbidden (expected, role), `/jurnal` render OK

---

## 2026-10-16 — Implementasi fase 1: tema Sorbet masuk aplikasi

User menyetujui prototipe → tema diimplementasi ke shell + sistem tema Laravel.

### Dibuat
- `resources/sass/_variables.scss` — variabel kompilasi Bootstrap (warna,
  radius, shadow, font, fokus, tombol/input/card/dropdown/modal/tabel/badge/paginasi).
- `resources/sass/_tokens.scss` — port token `:root` prototipe (`--sw-*` +
  override `--bs-*`, termasuk perbaikan `--bs-link-color-rgb`).
- `resources/sass/_components.scss` — port lapisan komponen prototipe (seksi 2–19).

### Diedit
- `resources/sass/app.scss` — import aktif: variables → bootstrap → tokens →
  components → bootstrap-icons (npm, bukan CDN).
- `resources/views/layouts/app.blade.php` — shell baru (sidebar offcanvas,
  header, page, fonts bunny, tanpa `css/app.css`).
- `resources/views/layouts/loginapp.blade.php` — wrapper `login-page`, fonts.
- `resources/views/layouts/partials/{header,sidemenu,title}.blade.php` —
  header (brand/breadcrumb/user-chip+logout), sidemenu (nav-section +
  side-link, tanpa hack `<br>`), page-head (breadcrumb+h1+slot
  subtitle/actions).
- `resources/views/auth/login.blade.php` — login 2 kolom sesuai prototipe
  (panel merek, input-affix password, ingat saya, lupa sandi).
- `resources/views/admin/home.blade.php` — dashboard (banner, stat bento
  dengan data asli, aksi cepat, aturan penilaian, kamus predikat).
- `resources/js/app.js` — toggle sidebar mobile + toggle password.
- `public/css/app.css` — dikosongkan (beri komentar penunjuk SCSS).

### Catatan
- `php artisan view:clear` dijalankan: 15 file cache view dimiliki user
  `daemon` (Apache) menimpa permission user CLI — cache turunan, otomatis
  diregenerasi.
- `public/js/sidebar.js` tidak lagi direferensikan (logic pindah ke
  `resources/js/app.js`); file lama dibiarkan, minta izin bila ingin dihapus.
- Verifikasi nyata via `php artisan serve` + agent-browser:
  login (axe 0, kontras 18 elemen 0 gagal) → dashboard (data asli 66/582/24/62;
  axe 0; kontras 72 elemen 0 gagal; sidebar 264px/header 64px sesuai token) →
  Data Siswa (DataTables jalan; kontras 546 elemen 0 gagal). Mobile 390px:
  offcanvas + backdrop OK, tanpa overflow. Dropdown user-chip OK.
- Sisa axe 1 pelanggaran di `/student` = `select-name` (select filter tanpa
  label) — bug markup lama, masuk daftar fase 2 sweep.

## 2026-10-15 — Prototipe tema Sorbet Lantern Bento (fase verifikasi)

Scope: **hanya** `/docs/prototype/` (baru) + `.gitignore` (edit). Tidak menyentuh
`resources/`, `package.json`, rute, controller, atau DB.

### Dibuat
- `docs/prototype/{index,login,dashboard,siswa}.html` — hub, login 2 kolom,
  shell+dashboard, halaman Data Siswa (filter, tabel search/paging, modal).
- `docs/prototype/assets/theme.css` — token Sorbet + override `--bs-*` +
  komponen kustom (sumber kebenaran untuk implementasi SCSS nanti).
- `docs/prototype/assets/app.js` — toggle sidebar, demo search/paging, toggle password.
- `docs/prototype/assets/vendor/` — Bootstrap 5.3.1 lokal (css + bundle js).
- `docs/prototype/DESIGN-SYSTEM.md` — spesifikasi token, aturan semantik, hasil verifikasi.

### Diedit
- `.gitignore` — tambah `/docs`.

### Ronda verifikasi (hasil akhir)
- Kontras terkomputasi (latar komposit): 377 elemen × 4 halaman → 0 gagal ≥4.5:1.
- axe-core 4.12.1: 0 pelanggaran di 4 halaman.
- Mobile 375px: tanpa overflow; sidebar offcanvas; input 16px.
- Keyboard: ring fokus 2px global + 3px untuk link/tombol/sidebar.
- Fungsi: search/paging tabel, modal, dropdown, toggle sidebar — lulus.
- Perbaikan hasil ronda terdokumentasi penuh di `docs/prototype/DESIGN-SYSTEM.md`
  (badge tint, alert, link rgb, var semantik Bootstrap, text-bg-primary,
  pagination, checkbox, heading-order) — wajib diwariskan ke implementasi SCSS.
