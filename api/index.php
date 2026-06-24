<?php

// 1. Definisikan lingkungan produksi & debug
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'true'; 

// 2. Siapkan database SQLite otomatis di folder /tmp
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = $dbPath;
$_ENV['LOG_CHANNEL'] = 'stderr';

// 3. SOLUSI UTAMA: Buat struktur folder bootstrap/cache dan storage di /tmp yang bersifat writable
$runtimeDirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/bootstrap/cache'
];

foreach ($runtimeDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// 4. Jalankan bootstrap Autoload Laravel
require __DIR__ . '/../vendor/autoload.php';

// 5. Override jalur bootstrap cache sebelum memuat app.php
// Kita beri tahu Laravel untuk membaca & menulis cache ke /tmp/bootstrap/cache
if (!defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

// Mengakali letak bootstrap cache menggunakan variable global sebelum kernel berjalan
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Atur ulang jalur storage dan cache manifest secara runtime
$app->useStoragePath('/tmp/storage');
$app->useBootstrapPath('/tmp/bootstrap');

// 6. Jalankan aplikasi seperti biasa
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);