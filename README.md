<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/kelasweekend/serkom-junior-web-dev-lsp/main/public/fe/img/logo.png" width="400" alt="Buson Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Tentang Buson

Buson ID adalah sistem pembelian tiket bus online yang menghubungkan seluruh armada bus yang ingin berkolaborasi bersama dalam satu platform website
untuk menjadi portal penjualanan tiket bus secara online dan cepat.

Buson Enjoy Your Trip 😎

## Fitur Website

- Mengelola armada bus sesuai kategori [ Eksekutif, Ekonomi, dan Bisnis ]
- Analytics Transaksi Perhari 
- Form Order 
- Form Cek harga Tiket


## Cara Menggunakan

Sebelum installasi pastikan anda memenuhi kriteria system berikut ini
- Laravel Version: 9.X
- PHP Version: 8.X

### Tahap Pertama
```bash
git clone https://github.com/kelasweekend/serkom-junior-web-dev-lsp.git buson
```

### Tahap Kedua
```bash
cd buson
```

### Tahap Ketiga
```bash
cp .env.example .env
```

### Tahap KeEmpat
```bash
composer update
```

### Tahap Kelima
```bash
Setting ENV DB database name 
```

### Tahap Keenam
```bash
php artisan key:generate
```

### Tahap Ketujuh
```bash
php artisan migrate
```

### Tahap Akhir
```bash
php artisan serve
```

## Security Vulnerabilities

If you discover a security vulnerability within Busson, please send an e-mail to Ojan Alpha. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
