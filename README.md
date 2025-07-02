# 📦 Bantuan Sosial Fahrudin

**Aplikasi Web Pendataan & Penilaian Kelayakan Penerima Bantuan Sosial**  
Dibuat dengan Laravel 12, Bootstrap 5.3.3, dan Font Awesome 6.5  
🎓 Proyek Akademik oleh Fahrudin (STI202202909)

![<img src="public/screenshots/dashboard.png" width="400"/>](public/screenshots/dashboard.png)

---

Aplikasi ini membantu mengelola data penerima bantuan sosial dengan sistem penilaian kelayakan otomatis. Pengguna dapat menambahkan data penerima, melakukan penilaian berdasarkan kriteria sosial ekonomi, dan memfilter data secara dinamis.

---

## 🚀 Fitur Unggulan

- 🔁 **Manajemen Data Penerima**
  - Tambah, edit, lihat, hapus data dengan validasi otomatis.
  - Validasi NIK unik (16 digit), tanggal lahir, dan data penting lainnya.

- 🧠 **Sistem Penilaian Kelayakan Otomatis**
  - Berdasarkan pendapatan, jumlah tanggungan, dan kondisi rumah:
    - Pendapatan: ≤1 juta (40 poin), 1–2 juta (20 poin), >2 juta (0 poin)
    - Tanggungan: ≥5 orang (30 poin), 3–4 orang (15 poin), <3 (0 poin)
    - Kondisi Rumah: Tidak Layak (30), Kurang Layak (15), Layak (0)
  - Output kategori: `Sangat Layak`, `Layak`, `Kurang Layak`, `Tidak Layak`

- 🔎 **Filter & Pencarian Dinamis**
  - Berdasarkan skor kelayakan, pendapatan, jumlah tanggungan, kondisi rumah
  - Termasuk pagination agar efisien di data besar

- 📱 **Desain Responsif & Modern**
  - Bootstrap 5.3.3 dengan nuansa warna merah `#b30000`
  - UX ditingkatkan dengan gradien form dan ikon di dalam input

- 🧹 **Cascade Delete**
  - Menghapus penerima otomatis menghapus data penilaiannya

---

## 🛠️ Teknologi

| Teknologi       | Versi     | Keterangan                            |
|----------------|-----------|----------------------------------------|
| Laravel        | 12.x      | Backend framework                      |
| MySQL          | -         | Penyimpanan data relasional            |
| Bootstrap      | 5.3.3     | Desain antarmuka responsif             |
| Font Awesome   | 6.5.0     | Ikon visual                            |
| PHP            | 8.1+      | Bahasa pemrograman backend             |
| Composer/NPM   | -         | Manajemen dependensi                   |

---

## 📂 Struktur Proyek

| Path                                      | Deskripsi                                      |
|-------------------------------------------|------------------------------------------------|
| `app/Http/Controllers/`                  | Folder controller utama aplikasi              |
| ├── `PenerimaBantuanController.php`      | Mengelola data penerima bantuan               |
| └── `AssessmentPenerimaController.php`   | Mengelola proses penilaian kelayakan          |
| `app/Models/`                            | Model Eloquent untuk database                 |
| ├── `PenerimaBantuan.php`                | Model penerima bantuan                        |
| └── `AssessmentPenerima.php`             | Model penilaian kelayakan                     |
| `database/migrations/`                   | File migrasi untuk struktur tabel             |
| ├── `create_penerima_bantuan_table.php`  | Migrasi tabel `penerima_bantuan`              |
| └── `create_assessment_penerima_table.php`| Migrasi tabel `assessment_penerima`           |
| `resources/views/`                       | Template Blade untuk tampilan pengguna        |
| ├── `penerima/`                          | Halaman untuk kelola data penerima            |
| └── `assessment/`                        | Halaman untuk form penilaian                  |
| `public/screenshots/`                    | Folder gambar untuk README                    |
| ├── `dashboard.png`                      | Cuplikan antarmuka aplikasi                   |
| └── `erd.png`                            | Diagram ERD aplikasi                          |
| `routes/web.php`                         | Rute web untuk aplikasi Laravel               |
| `.env.example`                           | Contoh file environment                       |
| `README.md`                              | Dokumentasi proyek                            |

---

## 📊 Struktur Database

### Tabel `penerima_bantuan`
- `id` (primary key)
- `nik` (unik, 16 karakter)
- `nama`
- `tanggal_lahir`
- `jenis_kelamin` (`Laki-laki`, `Perempuan`)
- `alamat`
- `status_bantuan` (`Aktif`, `Tidak Aktif`)
- `created_at`, `updated_at`

### Tabel `assessment_penerima`
- `id` (primary key)
- `penerima_id` (foreign key ke `penerima_bantuan`, cascade on delete)
- `pendapatan_bulanan`
- `jumlah_tanggungan`
- `kondisi_rumah` (`Layak Huni`, `Kurang Layak`, `Tidak Layak`)
- `skor_kelayakan` (0–100)
- `kategori_kelayakan` (`Sangat Layak`, `Layak`, `Kurang Layak`, `Tidak Layak`)
- `catatan` (nullable)
- `tanggal_penilaian`, `created_at`, `updated_at`

---

![Diagram ERD](public/screenshots/erd.png)

---

**Proyek ini dibangun sebagai solusi praktis untuk mengelola bantuan sosial secara digital, akurat, dan transparan. Terima kasih telah mengunjungi repositori ini!**
