# Testing Checklist - SIAKAD DataTables & Validation

## Masalah yang Sudah Diperbaiki

### ✅ Error 404 pada /siswa

**Penyebab:** Method `index()` tidak ada di Siswa.php

**Solusi:** Tambahkan method index() yang load view

```php
function index()
{
    $this->template->load('template', 'siswa/view');
}
```

**Status:** FIXED ✅

---

## Testing Checklist

### 1. Halaman Siswa

```
URL: http://domain/siswa
Expected: Halaman view dengan DataTables muncul
Status: [ ] PASS  [ ] FAIL
```

### 2. DataTables Loading Data

```
Actions:
1. Buka DevTools (F12) → Network Tab
2. Refresh halaman /siswa
3. Lihat AJAX request ke /siswa/data

Expected:
- Request ke /siswa/data berhasil (200 OK)
- Response berisi JSON data
- Tabel menampilkan data dari database

Status: [ ] PASS  [ ] FAIL
```

### 3. Form Validation - Tambah Siswa

```
URL: http://domain/siswa/add

Scenario 1 - Field Kosong:
1. Klik tombol "Simpan" tanpa isi form
Expected: SweetAlert2 error "Data tidak boleh kosong"
Status: [ ] PASS  [ ] FAIL

Scenario 2 - NIM Duplicate:
1. Isi NIM yang sudah ada di database
2. Isi field lain dengan data valid
3. Klik "Simpan"
Expected: SweetAlert2 error "NIM sudah terdaftar!"
Status: [ ] PASS  [ ] FAIL

Scenario 3 - Data Valid:
1. Isi semua field dengan data valid
2. Upload foto (optional)
3. Klik "Simpan"
Expected:
- Redirect ke halaman /siswa
- SweetAlert2 success "Data berhasil disimpan!"
- Data muncul di tabel

Status: [ ] PASS  [ ] FAIL
```

### 4. Edit Siswa

```
URL: http://domain/siswa/edit/{nim}

Expected:
- Form pre-filled dengan data lama
- Bisa update data
- Validation tetap berjalan
- SweetAlert2 success muncul

Status: [ ] PASS  [ ] FAIL
```

### 5. Delete Siswa

```
Actions:
1. Klik tombol delete di tabel
2. Konfirmasi di SweetAlert2

Expected:
- Modal konfirmasi muncul
- Klik "Ya, Hapus!" → data dihapus
- Tabel auto-refresh data
- SweetAlert2 success "Data berhasil dihapus!"

Status: [ ] PASS  [ ] FAIL
```

### 6. Halaman Kelas

```
URL: http://domain/kelas

Expected: Halaman view dengan DataTables muncul (sama dengan Siswa)
Status: [ ] PASS  [ ] FAIL
```

### 7. Halaman Guru

```
URL: http://domain/guru

Expected: Halaman view dengan DataTables muncul (sama dengan Siswa)
Status: [ ] PASS  [ ] FAIL
```

### 8. Form Validation - Tambah Kelas

```
URL: http://domain/kelas/add

Scenario 1 - Field Kosong:
Expected: SweetAlert2 error "Data tidak boleh kosong"
Status: [ ] PASS  [ ] FAIL

Scenario 2 - Kode Kelas Duplicate:
Expected: SweetAlert2 error "Kode kelas sudah terdaftar!"
Status: [ ] PASS  [ ] FAIL

Scenario 3 - Data Valid:
Expected: Data tersimpan + SweetAlert2 success
Status: [ ] PASS  [ ] FAIL
```

### 9. Form Validation - Tambah Guru

```
URL: http://domain/guru/add

Scenario 1 - Field Kosong:
Expected: SweetAlert2 error "Data tidak boleh kosong"
Status: [ ] PASS  [ ] FAIL

Scenario 2 - NUPTK Duplicate:
Expected: SweetAlert2 error "NUPTK sudah terdaftar!"
Status: [ ] PASS  [ ] FAIL

Scenario 3 - Data Valid:
Expected: Data tersimpan + SweetAlert2 success
Status: [ ] PASS  [ ] FAIL
```

---

## Browser Console Errors

Open DevTools (F12) dan check Console tab untuk error:

### Expected Console Errors: NONE

```
[ ] No red errors
[ ] No 404 requests
[ ] All AJAX requests 200 OK
[ ] All local assets loaded (CSS, JS)
```

### Expected Warnings: OK (ignore)

```
✅ Class 'CI_Controller' is not imported (normal)
✅ Class 'SSP' is not imported (normal)
```

---

## Quick Debug

Jika ada 404 error:

### 1. Cek Method Exists

```php
// Di Siswa.php cek ada:
function index() { ... }
function data() { ... }
function add() { ... }
function edit() { ... }
function delete() { ... }
```

### 2. Cek Routes

```php
// Di routes.php cek:
$route['default_controller'] = 'welcome';
// CodeIgniter auto-route: /siswa → siswa/index
```

### 3. Cek View Files

```
application/views/siswa/view.php
application/views/kelas/view.php
application/views/guru/view.php
```

### 4. Cek Assets

```
assets/bower_components/datatables.net/
assets/bower_components/datatables.net-bs/
assets/sweetalert2/
```

---

## Summary

**Sebelum perbaikan:**

- ❌ /siswa → 404 Not Found
- ❌ Method index() tidak ada

**Sesudah perbaikan:**

- ✅ /siswa → halaman view + DataTables
- ✅ /siswa/data → JSON data
- ✅ Form validation + SweetAlert2
- ✅ Duplicate check sebelum insert

---

## Struktur Controller yang Benar

```
Controller
├── __construct()           ← Init library & model (NO output)
├── data()                  ← Handle JSON untuk DataTables
├── index()                 ← Load view ONLY
├── add()                   ← POST: Form validation + duplicate check
│                          ← GET: Load form view
├── edit()                  ← POST: Update + validation
│                          ← GET: Pre-fill form
├── delete()                ← Delete data
└── helper_methods()        ← Upload, etc
```

---

## Next Steps (Optional)

1. Update edit form dengan validation
2. Add column sorting & searching
3. Add pagination limit
4. Add export to Excel
5. Add import from CSV
