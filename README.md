# SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN KETUA OSIS MENGGUNAKAN METODE SAW

## clone project

```
https://github.com/akmaalll/PemilihanKetuaOsis.git
```

## setup database

`rename example.env to .env`

## setup project

```
composer install

php artisan key:generate
```

## run migration

```
php artisan migate
or
php artisan migate:fresh --seed

```

## run project

```
php artisan serve

```
