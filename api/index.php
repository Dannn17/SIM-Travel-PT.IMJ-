<?php

// 1. Definisikan lingkungan produksi & debug
$_ENV['APP_ENV'] = 'production';
$_ENV['APP_DEBUG'] = 'true'; // Biarkan true dulu untuk memastikan web benar-benar menyala

// 2. Siapkan database SQLite otomatis di folder /tmp
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}
$_ENV['DB_CONNECTION'] = 'sqlite';
$_ENV['DB_DATABASE'] = $dbPath;

// 3. SOLUSI ERROR: Alahkan Log ke stderr (agar dibaca oleh Vercel Logs, bukan file)
$_ENV['LOG_CHANNEL'] = 'stderr';

// 4. Jalankan bootstrap Autoload Laravel
require __DIR__ . '/../vendor/autoload.php';

// 5. SOLUSI ERROR CACHE: Alihkan folder bootstrap/cache dan storage ke /tmp yang bisa ditulis
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Memaksa Laravel menggunakan folder /tmp untuk menyimpan cache view, session, dan log internal
$app->useStoragePath('/tmp/storage');

// Membuat struktur folder storage darurat di dalam /tmp jika belum ada
if (!is_dir('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0755, true);
}

// 6. Jalankan aplikasi seperti biasa
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);