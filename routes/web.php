<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CareerController;

Route::get('/',  [ResumeController::class, 'index'])->name('resume.index');
Route::get('/upload', fn() => redirect()->route('resume.index'));
Route::post('/upload',          [ResumeController::class, 'upload'])->name('resume.upload');
Route::post('/chat/message',    [ResumeController::class, 'chatMessage'])->name('chat.message');
Route::post('/chat/save',       [ResumeController::class, 'saveChat'])->name('chat.save');
Route::post('/download-report', [ResumeController::class, 'downloadReport'])->name('download.report');
Route::get('/privacy', fn() => view('privacy'))->name('privacy');
Route::get('/terms',   fn() => view('terms'))->name('terms');

Route::middleware('auth')->prefix('history')->name('history.')->group(function () {
    Route::get('/',                    [HistoryController::class, 'index'])->name('index');
    Route::get('/{chatSession}',       [HistoryController::class, 'show'])->name('show');
    Route::post('/{chatSession}/download', [HistoryController::class, 'downloadReport'])->name('download');
    Route::delete('/{chatSession}',    [HistoryController::class, 'destroy'])->name('destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',          [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users',                 [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/analyses', [AdminController::class, 'userAnalyses'])->name('user.analyses');
    Route::delete('/users/{user}',       [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::get('/analyses',              [AdminController::class, 'analyses'])->name('analyses');
    Route::delete('/analyses/{analysis}',[AdminController::class, 'deleteAnalysis'])->name('analyses.destroy');
    Route::resource('skills',  SkillController::class)->except(['show']);
    Route::resource('careers', CareerController::class)->except(['show']);
});

require __DIR__.'/auth.php';