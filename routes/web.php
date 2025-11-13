<?php

use App\Models\about;
use App\Models\Home;
use App\Models\instructor;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $homes = Home::orderBy('id', 'DESC')->limit(2)->get();
    return view('compro.index', compact('homes'));
})->name('home.index');
Route::get('about', function () {
    $about = about::orderBy('id', 'DESC')->first();
    $inst = instructor::orderBy('id', 'DESC')->get();
    return view('compro.about', compact('about','inst'));
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
Route::get('home-admin/edit/{id}', [\App\Http\Controllers\HomeController::class, 'edit'])->name('home-admin.edit');
Route::put('home-admin/update/{id}', [\App\Http\Controllers\HomeController::class, 'update'])->name('home-admin.update');
Route::delete('home-admin/destroy/{id}', [\App\Http\Controllers\HomeController::class, 'destroy'])->name('home-admin.destroy');
Route::resource('about-admin', \App\Http\Controllers\AboutController::class);
Route::resource('inst-admin', \App\Http\Controllers\InstructorController::class);

