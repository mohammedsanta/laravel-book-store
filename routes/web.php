<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;

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

// Book Methods

Route::controller(BookController::class)->group(function () {
    // Show Books
    Route::get('/','index')->middleware('auth');

    // Show Books
    Route::get('/books','index')->name('index.book');

    // Show Books By Tag
    Route::get('/books/tag/','tag')->name('index.books.tag');

    // Create Book View
    Route::get('/books/create','create')->name('create.book');

    // Create Comment
    Route::post('/books/{id}/comment','comment')->name('comment.book');

    // Show Book By Id
    Route::get('/book/{id}','show')->name('book.show');

    // Edit Book View
    Route::get('/book/{id}/edit','edit')->name('book.edit');

    // Functionality Create Book
    Route::post('/books','store')->name('store.book');

    // Functionality Update Book
    Route::post('/book/{id}','update')->name('update.book');

    // Functionality Delete Book
    Route::delete('/book/{id}/delete','destroy')->name('destroy.book');
});


// Authentication Methods

Route::controller(AuthController::class)->group(function () {
    // User Profile
    Route::get('/user/profile','profile')->name('profile.view');
    
    // User Info Form
    Route::get('/user/profile/info','info')->name('info.view');
    
    // Login Page
    Route::get('/auth/login','index')->name('login.view')->middleware('guest');
    
    // Signup Page
    Route::get('/auth/signup','create')->name('signup.view');

    // User Form
    Route::post('/user/profile/{id}/info','infoUpdate')->name('info.update');

    // Update Picture
    Route::post('/user/{id}/profile/pic','update')->name('profile.update');

    // Functionality Signup
    Route::post('/auth/signup','signup')->name('signup');

    // Functionality Login
    Route::post('/auth/login','login')->name('login');

    // Functionality Logou
    Route::post('/auth/logout','logout')->name('logout');
});