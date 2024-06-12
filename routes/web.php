<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/decision-tree', function () {
    return view('dtree.index');
})->name('decision-tree');

Route::get('/svm', function () {
    return view('svm.index');
})->name('svm');

// Rotas de upload
Route::post('/svm/upload', [FileController::class, 'uploadSVM'])->name('svm.upload');
Route::post('/decision-tree/upload', [FileController::class, 'uploadDecisionTree'])->name('decision-tree.upload');

// Rotas para exibir as telas de download
Route::get('/decision-tree/show/{filename}', [FileController::class, 'showDecisionTreeDownload'])->name('decision-tree.show');
Route::get('/svm/show/{filename}', [FileController::class, 'showSVMDownload'])->name('svm.show');

// Rotas para download
Route::get('/download/{filename}', [FileController::class, 'downloadFile'])->name('download');

Route::fallback(function () {
    return redirect('/');
});
