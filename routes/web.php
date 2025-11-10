<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('compro.index');
})->name('home.index');
Route::get('about', function () {
    return view('compro.about');
})->name('about.index');
Route::get('courses', function () {
    return view('compro.courses');
})->name('courses.index');
Route::get('contact', function () {
    return view('compro.contact');
})->name('contact.index');
Route::get('testimonial', function () {
    return view('compro.testimonial');
})->name('testimonial.index');
Route::get('team', function () {
    return view('compro.team');
})->name('team.index');


Route::get('login', function () {
    return view('admin.login');
})->name('login.index');
Route::get('dashboard', function () {
    return view('admin.app');
});
Route::get('home-admin', [\App\Http\Controllers\HomeController::class, 'index'])->name('home-admin.index');
Route::get('home-admin/create', [\App\Http\Controllers\HomeController::class, 'create'])->name('home-admin.create');
Route::post('home-admin/store', [\App\Http\Controllers\HomeController::class, 'store'])->name('home-admin.store');

