<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkerNonTeachingController;
use App\Http\Controllers\WorkerTeachingController;


route::get('/login', [AuthController::class, 'login'])->name('login');
route::post('/login/auth', [AuthController::class, 'authenticate'])->name('auth');

route::get('/register', [AuthController::class, 'register'])->name('register');
route::post('/register/store', [AuthController::class, 'store'])->name('saveUser');
route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::fallback(function () {
    return redirect()->route('login');
});


route::middleware(['auth', 'verified'])->group(function () {

    // route::middleware(['auth', 'can:master'])->get('/', function () {
    route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // route::get('admin/nonteaching/{alfa}', [WorkerNonTeachingController::class, 'index'])->name('nonteaching.index');
    route::resource('admin/nonteaching', WorkerNonTeachingController::class)->except(['destroy'])->names('nonteaching');
    route::resource('admin/teaching', WorkerTeachingController::class)->except(['destroy'])->names('teaching');

    route::delete('admin/delete', [WorkerNonTeachingController::class, 'destroyByCi'])->name('destory');

    Route::fallback(function () {
        return redirect()->to('/');
    });
});
