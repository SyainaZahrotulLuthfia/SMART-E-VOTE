<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## SMART E-VOTE

SMART E-Vote adalah aplikasi e-voting berbasis Laravel yang dirancang untuk mempermudah proses pemilihan secara digital. Cocok digunakan untuk sekolah, kampus, organisasi, atau lembaga lainnya.

## Teknologi yang Digunakan

Aplikasi SMART E-VOTE dibangun menggunakan beberapa teknologi berikut:

- **[Laravel](https://laravel.com/)** – Framework PHP untuk backend
- **[MySQL](https://www.mysql.com/)** – Database manajemen
- **[Blade](https://laravel.com/docs/blade)** – Template engine bawaan Laravel
- **[JavaScript](https://www.javascript.com/)** – Interaktivitas frontend
- **[Node.js & NPM](https://nodejs.org/)** – Untuk manajemen dependensi frontend
- **[Vite](https://vitejs.dev/)** – Tools bundler untuk build dan dev server
- **[Cuba Admin Template](https://themeforest.net/item/cuba-admin-dashboard-template/30896001)** – Template dashboard modern berbasis Bootstrap 5



## Fitur
- Login Admin dan Siswa
- Voting hanya satu kali
- Dashboard statistik real-time
- Data siswa, pemilihan, dan kandidat
- Grafik hasil voting
- Riwayat pemilihan
- Sistem pemilihan aktif/berakhir otomatis
- Tampilan modern menggunakan Cuba Admin Template

## Instalasi

bash
git clone https://github.com/SyainaZahrotulLuthfia/SMART-E-VOTE.git smart-evote
cd smart-evote
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate

# Atur konfigurasi database di .env
# DB_DATABASE=smart_evoting
# DB_USERNAME=root
# DB_PASSWORD=

php artisan migrate --seed
php artisan serve


## Akun Default 

txt
{Admin}
Email     : admin@gmail.com 
Password  : 123456

{Siswa}
Email     : student@gmail.com 
Password  : 123456

## Tampilan Aplikasi

Berikut beberapa tampilan dari SMART E-VOTE:

- Login SMART E-VOTE
- Dashboard Admin
- Data Kelas
- Data Siswa
- Data Pemilihan
- Tambah Pemilihan
- Data Calon Kandidat
- Belum Voting
- Sudah Voting
- Dashboard Utama Siswa
- Dashboard Siswa Tampilan Calon Kandidat
- Dashboard Siswa Kandidat Terpilih

<p align="center">
  <img src="https://iili.io/FqPl194.png" width="600" alt="Login SMART E-VOTE">
  <img src="https://iili.io/FqPE8N4.png" width="600" alt="Dashboard Admin">
  <img src="https://iili.io/FqPjud7.png" width="600" alt="Data Kelas">
  <img src="https://iili.io/FqPjQEl.png" width="600" alt="Data Siswa">
  <img src="https://iili.io/FqPwtoJ.png" width="600" alt="Data Pemilihan">
  <img src="https://iili.io/FqPNaKQ.png" width="600" alt="Tambah Pemilihan">
  <img src="https://iili.io/FqPO6TF.png" width="600" alt="Data Calon Kandidat">
  <img src="https://iili.io/FqPvBI9.png" width="600" alt="Belum Voting">
  <img src="https://iili.io/FqPvwhX.png" width="600" alt="Sudah Voting">
  <img src="https://iili.io/FqPgc9R.png" width="600" alt="Dashboard Utama Siswa">
  <img src="https://iili.io/FqPUBII.png" width="600" alt="Dashboard Siswa Tampilan Calon Kandidat">
  <img src="https://iili.io/FqPUeCF.png" width="600" alt="Dashboard Siswa Kandidat Terpilih">
</p>

## Kontribusi

Kontribusi sangat terbuka!  
Jika kamu ingin membantu mengembangkan SMART E-VOTE:

1. Fork repositori ini
2. Buat branch fitur: `git checkout -b fitur-baru`
3. Commit perubahanmu: `git commit -m 'Tambah fitur X'`
4. Push ke branch: `git push origin fitur-baru`
5. Buat Pull Request!

## Kontak

Dikembangkan oleh: Syaina Zahrotul Luthfia
Email: syainazahrotulluthfiaa@gmail.com 
GitHub: [@SyainaZahrotulLuthfia](https://github.com/SyainaZahrotulLuthfia)

## Lisensi

Aplikasi SMART E-VOTE adalah perangkat lunak sumber terbuka yang dilisensikan di bawah [Lisensi MIT](https://opensource.org/licenses/MIT).

