<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NftController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/collection', [NftController::class, 'collection'])->name('collection');
});

// Route pour la page de connexion
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route pour la page d'inscription
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route pour la page de déconnexion
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// route détail du nft
Route::get('/nfts/{id}', [NftController::class, 'show'])->name('nfts.show');

// Route pour la page d'ajout de NFT
Route::get('/addNft', [NftController::class, 'showAddForm'])->name('addNft');
Route::post('/addNft', [NftController::class, 'addNft']);

// revente et achat nft
Route::post('/nfts/{id}/purchase', [NftController::class, 'purchase'])->name('nfts.purchase');
Route::post('/nfts/{id}/sell', [NftController::class, 'sell'])->name('nfts.sell');
