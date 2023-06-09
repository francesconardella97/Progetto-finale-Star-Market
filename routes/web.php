<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\FrontController;
use App\Models\Announcement;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RevisorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[FrontController::class, 'welcome'] )->name('welcome');
Route::get('announcements',[AnnouncementController::class,'create'])->name('announcement.create')->middleware('auth');
Route::get('/categoria/{category}',[FrontController::class, 'categoryShow'])->name('categoryShow');
Route::get('announcements/{announcement}',[AnnouncementController::class,'show'])->name('announcement.show');
Route::get('/tutti/annunci',[AnnouncementController::class,'index'])->name('announcement.index');

// Home revisore
Route::get('/revisor/home',[RevisorController::class, 'index'])->name('revisor.index')->middleware('isRevisor');

// Accetta annuncio
Route::patch('/accetta/annuncio/{announcement}',[RevisorController::class, 'acceptAnnouncement'])->name('revisor.accept_announcement')->middleware('isRevisor');
// Annulla annuncio
Route::patch('/annulla/annuncio/{announcement}',[RevisorController::class, 'cancelAnnouncement'])->name('revisor.cancel_announcement')->middleware('isRevisor');

// Rifiuta annuncio
Route::patch('/rifiuta/annuncio/{announcement}',[RevisorController::class, 'rejectAnnouncement'])->name('revisor.reject_announcement')->middleware('isRevisor');

//Richiedi di diventare un revisor
Route::get('/richiesta/revisore',[RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');

//Rendi utente revisore
Route::get('/rendi/revisore/{user}',[RevisorController::class,'makeRevisor'])->name('make.revisor');

//ricerca annuncio
Route::get('/ricerca/annuncio',[FrontController::class,'searchAnnouncements'])->name('announcements.search');

//cambio lingua

Route::post('/{lang}', [FrontController::class, 'setLanguage'])->name('set_language_locale');