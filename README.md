# SIAKAD SD - Panduan Penggunaan

SIAKAD SD adalah aplikasi akademik sekolah berbasis CodeIgniter 3 untuk mengelola data siswa, guru, kelas, kurikulum, jadwal, nilai, wali kelas, dan pembayaran.

README ini ditulis untuk membantu pengguna baru memahami:
- apa fungsi aplikasi
- siapa saja role yang tersedia
- urutan setup yang benar
- alur kerja tiap menu utama
- catatan penting dari data contoh bawaan project

## Ringkasan

Fungsi utama aplikasi:
- mengelola master data sekolah
- mengatur tahun akademik aktif
- menyusun kurikulum per tingkatan (tanpa jurusan)
- membuat jadwal pelajaran
- input nilai oleh guru
- akses wali kelas untuk melihat kelasnya
- pencatatan pembayaran oleh admin/keuangan

Teknologi:
- PHP 8.1+
- CodeIgniter 3
- MySQL / MariaDB
- AdminLTE / jQuery / DataTables

**Catatan Penting:**
- Project ini dikonfigurasi khusus untuk **SD (Sekolah Dasar)**
- Fitur **jurusan (IPA/IPS) telah disembunyikan** dari tampilan UI karena SD tidak memiliki jurusan
- Data jurusan masih ada di database untuk kompatibilitas, namun tidak ditampilkan di form dan tabel
- Logika backend tetap berjalan normal, hanya tampilan yang diubah

## Role Pengguna

Role yang tersedia di database contoh:

| ID Level | Role | Fungsi Utama |
| --- | --- | --- |
| `1` | Admin | Mengelola seluruh data akademik dan konfigurasi |
| `2` | Wali Kelas | Melihat portal wali kelas, data siswa kelas, dan laporan nilai |
| `3` | Guru | Melihat jadwal mengajar dan input nilai |
| `4` | Keuangan | Mengelola pembayaran siswa |

Catatan:
- hak akses menu ditentukan oleh tabel `tabel_menu` dan `tbl_user_rule`
- beberapa menu juga punya pembatasan tambahan di controller
- contoh: menu pembayaran hanya boleh diakses Admin dan Keuangan

## Akun Demo

Data contoh bawaan:

| Role | Username | Password |
| --- | --- | --- |
| Administrator | `zuhri` | `123456` |
| Wali Kelas | `adam` | `123456` |
| Guru | `dita` | `123456` |
| Keuangan | `putri` | `123456` |

Catatan:
- login bisa berasal dari `tbl_user` atau `tbl_guru`
- untuk role Guru dan Wali Kelas, aplikasi mencoba menghubungkan akun ke data guru berdasarkan `username`

## Struktur Menu

Menu utama yang umum muncul untuk admin:
- `Dashboard`
- `Data Siswa`
- `Data Guru`
- `Data Master`
- `Jadwal Pelajaran`
- `Peserta Didik`
- `Walikelas`
- `Pengguna Sistem`
- `Menu`
- `Nilai`
- `Laporan Nilai`
- `Form Pembayaran`

Submenu pada `Data Master`:
- `Mata Pelajaran`
- `Ruangan Kelas`
- `Tingkatan Kelas`
- `Jurusan` (disembunyikan untuk SD)
- `Tahun Akademik`
- `Kelas`
- `Kurikulum`

Menu khusus wali kelas:
- `Portal Wali Kelas`
- `Siswa Kelas`

## Persyaratan Sistem

- PHP 8.1 sampai 8.4
- MySQL / MariaDB
- Apache atau web server lain
- `mod_rewrite` aktif direkomendasikan

## Instalasi

1. Letakkan project di folder web server.
2. Buat database, misalnya `pis_akademik`.
3. Import file `database/pis_akademik.sql`.
4. Atur koneksi database di `application/config/database.php`.
5. Atur `base_url` di `application/config/config.php`.
6. Pastikan folder `uploads/` bisa ditulis jika memakai upload file pembayaran atau import.
7. Buka aplikasi, misalnya `http://localhost:2045/`.

## Konfigurasi Penting

File yang paling sering diubah:
- `application/config/database.php`
- `application/config/config.php`
- `application/config/routes.php`

Yang perlu diperiksa saat pertama kali setup:
- host database
- username dan password database
- nama database
- `base_url`

**Konfigurasi Database Saat Ini:**
- Host: `localhost`
- Username: `root`
- Password: `Jal&jar123`
- Database: `pis_akademik`

## Alur Setup Awal

Agar aplikasi bisa dipakai tanpa error data kosong, urutan yang disarankan adalah:

1. Login sebagai Admin.
2. Cek `Tahun Akademik` dan pastikan ada satu yang aktif.
3. Cek `Tingkatan Kelas`.
4. Cek `Kelas`.
5. Cek `Mata Pelajaran`.
6. Cek `Ruangan Kelas`.
7. Cek `Data Guru`.
8. Isi `Kurikulum`.
9. Generate `Jadwal Pelajaran`.
10. Tentukan `Walikelas`.
11. Baru lanjut ke input nilai, portal wali kelas, dan pembayaran.

Catatan:
- **Jurusan tidak perlu di-setup** karena fitur ini disembunyikan untuk SD
- Jika salah satu data master di atas belum lengkap, menu turunan biasanya tampil kosong walaupun halaman bisa dibuka

## Alur Kerja per Modul

### 1. Data Siswa

Digunakan untuk:
- tambah siswa
- edit siswa
- import siswa dari Excel
- melihat siswa aktif
- proses naik kelas

Saran alur:
1. pastikan `Kelas` sudah ada
2. input siswa manual atau import Excel
3. cek kelas aktif siswa
4. gunakan fitur naik kelas saat pergantian tahun ajaran

### 2. Data Guru

Digunakan untuk:
- menyimpan data guru
- menyambungkan akun guru dengan username login

Catatan penting:
- untuk role Guru atau Wali Kelas, sebaiknya `username` di `Data Guru` sama dengan `username` akun login
- jika tidak sinkron, beberapa fitur berbasis `id_guru` bisa gagal mendeteksi data guru

### 3. Mata Pelajaran

Digunakan untuk menyimpan daftar mapel.

Catatan:
- tabel mapel bawaan hanya berisi kode dan nama mapel
- pemetaan mapel ke tingkatan dilakukan lewat `Kurikulum`, bukan lewat tabel mapel langsung

### 4. Ruangan Kelas

Digunakan untuk menentukan ruangan yang nanti dipakai di jadwal.

### 5. Tingkatan Kelas

Digunakan untuk level kelas, misalnya:
- `1` (Kelas 1 SD)
- `2` (Kelas 2 SD)
- `3` (Kelas 3 SD)
- `4` (Kelas 4 SD)
- `5` (Kelas 5 SD)
- `6` (Kelas 6 SD)

Catatan penting:
- data di `Kelas` bergantung ke `Tingkatan Kelas`
- jika data tingkatan rusak atau tidak cocok, beberapa view seperti `view_kelas` bisa kosong

### 6. Jurusan

**Disembunyikan untuk SD** - Fitur ini tidak ditampilkan di UI karena SD tidak memiliki jurusan IPA/IPS.

Catatan:
- Data jurusan masih ada di database untuk kompatibilitas
- Field jurusan di form kelas (tambah/edit) telah dikomentari
- Kolom jurusan di tabel view telah disembunyikan
- Menu jurusan di sidebar telah disembunyikan

### 7. Kelas

Digunakan untuk menyimpan kombinasi:
- kode kelas
- nama kelas
- tingkatan

Contoh untuk SD:
- `1-A` untuk kelas 1-A
- `2-B` untuk kelas 2-B
- `6-C` untuk kelas 6-C

Catatan:
- Field jurusan di form kelas tidak ditampilkan (dikomentari)
- Data jurusan masih tersimpan di database jika diperlukan di masa depan

### 8. Tahun Akademik

Digunakan untuk:
- menentukan tahun ajaran aktif
- menentukan semester aktif

Catatan penting:
- banyak modul membaca data dari tahun akademik aktif
- pastikan hanya ada satu data dengan `is_aktif = Y`

### 9. Kurikulum

Kurikulum adalah jantung pembentukan jadwal.

Modul ini dipakai untuk:
- menambah nama kurikulum
- menentukan aktif / tidak aktif
- menambah detail kurikulum per mapel dan tingkatan (tanpa jurusan untuk SD)

Alur yang benar:
1. buka `Data Master > Kurikulum`
2. tambah atau pilih kurikulum
3. klik `View Detail`
4. pilih filter `Tingkatan` (jurusan tidak perlu dipilih untuk SD)
5. klik `Tambah Data`
6. tambahkan mapel satu per satu ke detail kurikulum

Catatan penting:
- `Generate Jadwal` mengambil data dari `tbl_kurikulum_detail`
- Untuk SD, detail kurikulum hanya perlu diisi per tingkatan tanpa jurusan
- Jika detail kurikulum untuk tingkatan tertentu kosong, jadwal tingkatan tersebut tidak akan terbentuk

### 10. Jadwal Pelajaran

Halaman ini dipakai untuk dua tahap:

Tahap 1, generate slot jadwal:
1. buka menu `Jadwal Pelajaran`
2. klik tombol `Generate Jadwal`
3. pilih `Kurikulum`
4. pilih `Semester`
5. klik `Generate Data`

Tahap 2, isi detail jadwal:
1. pilih `Tingkatan Kelas`
2. pilih `Kelas`
3. sistem akan menampilkan daftar mapel hasil generate
4. isi `Guru`
5. isi `Ruangan`
6. isi `Hari`
7. isi `Jam`

Catatan penting:
- di aplikasi saat ini tidak ada form tambah jadwal manual satu baris dari nol
- data jadwal dibuat massal dari kurikulum, lalu diedit di halaman jadwal
- jika tombol generate diklik berulang, potensi data ganda bisa terjadi karena belum ada validasi duplikasi yang ketat
- untuk SD, filter jurusan di form jadwal tidak ditampilkan

### 11. Walikelas

Modul ini dipakai untuk menetapkan guru sebagai wali kelas pada tahun akademik aktif.

Ketergantungan:
- data guru harus ada
- data kelas harus ada
- tahun akademik aktif harus ada

Catatan:
- Tampilan tabel walikelas tidak menampilkan kolom jurusan (disembunyikan untuk SD)

### 12. Portal Wali Kelas

Dipakai oleh role Wali Kelas untuk melihat ringkasan kelas yang menjadi tanggung jawabnya.

Agar modul ini bekerja:
- akun wali kelas harus punya `id_guru`
- guru tersebut harus terpasang di `tbl_walikelas`
- harus ada tahun akademik aktif

Jika tidak cocok, aplikasi akan menampilkan pesan bahwa data wali kelas belum ditemukan.

### 13. Siswa Kelas

Dipakai wali kelas untuk melihat daftar siswa di kelasnya.

Catatan:
- Filter jurusan di form siswa aktif tidak ditampilkan (disembunyikan untuk SD)
- JavaScript telah diupdate untuk mengirim jurusan kosong saat load kelas

### 14. Nilai

Dipakai guru untuk:
- melihat daftar kelas mengajar
- masuk ke form penilaian
- menyimpan nilai siswa

Ketergantungan:
- jadwal sudah ada
- guru pada jadwal sudah terisi
- siswa pada kelas tersebut sudah ada

Catatan:
- Tampilan form nilai tidak menampilkan jurusan (hanya tingkatan dan nama kelas)
- Tampilan list kelas tidak menampilkan kolom jurusan

### 15. Laporan Nilai

Dipakai untuk melihat atau mencetak hasil nilai siswa.

### 16. Form Pembayaran

Dipakai Admin dan Keuangan untuk:
- mencatat pembayaran
- edit pembayaran
- cetak kwitansi

Data yang biasa diisi:
- tanggal
- siswa
- jenis pembayaran
- nominal
- metode
- status
- keterangan
- bukti pembayaran

## Alur Operasional yang Direkomendasikan

Untuk SD yang baru mulai menggunakan aplikasi ini, urutan kerja paling aman adalah:

1. isi semua master data (tanpa perlu setup jurusan)
2. tentukan tahun akademik aktif
3. isi data guru
4. isi data kelas (per tingkatan saja)
5. isi kurikulum per tingkatan (tanpa jurusan)
6. generate jadwal
7. lengkapi guru, ruangan, hari, jam di jadwal
8. tetapkan wali kelas
9. input atau import siswa
10. input nilai
11. gunakan portal wali kelas dan laporan
12. gunakan pembayaran bila dibutuhkan

## Seeder

Tersedia controller `Seeder` untuk membantu memperbaiki sebagian data menu dan relasi guru/wali kelas.

Fungsi utamanya:
- memastikan menu wali kelas tersedia
- memastikan rule akses level 2 tersedia
- menghubungkan akun `tbl_user` level 2/3 ke `tbl_guru` berdasarkan username
- mencoba mengisi slot wali kelas kosong untuk tahun akademik aktif

Catatan:
- seeder ini membantu struktur akses
- seeder ini tidak mengisi detail kurikulum, tidak membuat jadwal otomatis, dan tidak melengkapi master data sekolah

## Catatan Data Contoh Project

Beberapa hal yang perlu dipahami dari database contoh:

- data bawaan belum selalu lengkap untuk semua alur
- jurusan masih ada di database untuk kompatibilitas, namun tidak ditampilkan di UI
- akibatnya, form dan tabel yang sebelumnya menampilkan jurusan sekarang tidak menampilkannya
- fitur jurusan dapat dikembalikan dengan mudah dengan menghilangkan komentar pada kode yang relevan

Jadi jika menemukan halaman kosong, cek dulu:
- apakah master data relasi sudah lengkap
- apakah tahun akademik aktif ada
- apakah kurikulum detail sudah diisi
- apakah akun login sudah terhubung ke data guru

## Troubleshooting

### Halaman terbuka tapi tabel kosong

Cek:
- data master terkait ada atau tidak
- view database seperti `view_kelas` / `view_walikelas` menghasilkan data atau tidak
- data referensi `tingkatan`, `kelas`, dan `tahun akademik` cocok

### Jadwal tidak muncul untuk tingkatan tertentu

Penyebab paling umum:
- `tbl_kurikulum_detail` untuk tingkatan tersebut belum ada

Solusi:
- buka `Kurikulum`
- masuk ke `View Detail`
- tambahkan mapel untuk tingkatan yang dibutuhkan
- generate ulang jadwal

### Wali kelas tidak bisa masuk portal

Cek:
- akun login punya `id_guru`
- username akun sama dengan username pada `Data Guru`
- ada data `tbl_walikelas` untuk tahun akademik aktif

### Guru tidak melihat jadwal mengajar

Cek:
- jadwal sudah dibuat
- `id_guru` pada jadwal sudah terisi
- akun guru terhubung dengan benar

### Login berhasil tapi menu tidak lengkap

Cek:
- role user
- rule akses pada `tbl_user_rule`
- struktur menu pada `tabel_menu`

## Catatan Kompatibilitas PHP 8

Project ini sudah disesuaikan agar dapat berjalan di PHP 8.1+.

Perbaikan yang telah dilakukan di repo ini meliputi:
- penyesuaian beberapa library lama agar kompatibel dengan PHP 8
- perbaikan syntax dan error parsing di beberapa controller
- penyesuaian agar login, menu, dan beberapa modul utama dapat berjalan lebih stabil

## Perubahan Khusus untuk SD

Modifikasi yang telah dilakukan untuk adaptasi ke SD:

1. **Menu Jurusan disembunyikan** dari sidebar (template.php)
2. **Field jurusan di form kelas** (add.php & edit.php) dikomentari
3. **Kolom jurusan di tabel kelas view** disembunyikan (header & DataTables)
4. **Filter jurusan di siswa aktif** dikomentari, JavaScript diupdate
5. **Tampilan jurusan di form nilai** diganti dengan tingkatan saja
6. **Kolom jurusan di walikelas view** disembunyikan
7. **Kolom jurusan di list_kelas nilai** disembunyikan

Semua perubahan dilakukan dengan cara **mengomentari (comment)** kode, sehingga:
- Logika backend tetap berjalan normal
- Struktur database tidak berubah
- Kode dapat dikembalikan dengan mudah jika dibutuhkan
- Aplikasi tetap berfungsi untuk SD tanpa menampilkan jurusan

## Rekomendasi Belajar untuk Pengguna Baru

Jika baru pertama kali memakai aplikasi ini untuk SD, pelajari dalam urutan berikut:

1. pahami menu dan role
2. pahami master data (tanpa jurusan)
3. pahami hubungan `Tingkatan -> Kelas`
4. pahami hubungan `Kurikulum -> Jadwal`
5. pahami hubungan `Guru -> Jadwal -> Nilai`
6. pahami hubungan `Wali Kelas -> Portal Wali Kelas`

Urutan ini akan membuat aplikasi lebih mudah dipelajari dibanding langsung mencoba semua menu sekaligus.

## Penutup

SIAKAD ini paling stabil jika dipakai dengan pendekatan berurutan:
- lengkapi data master (tanpa jurusan)
- aktifkan tahun akademik
- isi kurikulum per tingkatan
- generate jadwal
- baru operasikan modul akademik lainnya

Jika ingin mengembangkan project ini lebih lanjut, area yang paling layak ditingkatkan adalah:
- validasi duplikasi generate jadwal
- wizard setup awal khusus SD
- auto-clone kurikulum antar tingkatan
- dokumentasi menu per role
- validasi integritas data master
