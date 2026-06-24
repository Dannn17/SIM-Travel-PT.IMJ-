<?php

// Mengarahkan ke file autoload bawaan vendor Laravel
require __DIR__ . '/../vendor/autoload.php';

// Menjalankan aplikasi bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Menangani request yang masuk ke server
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);