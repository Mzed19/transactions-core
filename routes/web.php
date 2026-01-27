<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/download/postman-collection', function () {
    $filePath = base_path('Transactions Core.postman_collection.json');
    
    if (!file_exists($filePath)) {
        abort(404, 'Arquivo não encontrado');
    }
    
    return response()->download($filePath, 'Transactions Core.postman_collection.json', [
        'Content-Type' => 'application/json',
    ]);
})->name('postman.download');
