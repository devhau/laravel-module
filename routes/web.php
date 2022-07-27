<?php

use Illuminate\Support\Facades\Route;

use Laravel\Sanctum\Http\Controllers\CsrfCookieController;

Route::get('/csrf', [CsrfCookieController::class, 'show']);
Route::group(router_home(), function () {
    Route::get('/', router_config('home.page'));
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login',  \DevHau\Modules\Http\Livewire\Auth\Login::class)->name('login');
        Route::get('register',  \DevHau\Modules\Http\Livewire\Auth\Register::class)->name('register');
    });
});

Route::group(router_admin(), function () {
    Route::get('/', router_config('admin.page'))->name('admin.dashboard');
    Route::get('/table/{module}', \DevHau\Modules\Http\Livewire\Admin\Table\Index::class)->name('admin.table');
    Route::get('/module', \DevHau\Modules\Http\Livewire\Admin\Module\Index::class)->name('admin.module');
    Route::get('/user', \DevHau\Modules\Http\Livewire\Admin\User\Index::class)->name('admin.user');
    Route::get('/user/{userId}/permission', \DevHau\Modules\Http\Livewire\Admin\User\Permission::class)->name('admin.user.permission');
    Route::get('/permission', \DevHau\Modules\Http\Livewire\Admin\Permission\Index::class)->name('admin.permission');
    Route::get('/role', \DevHau\Modules\Http\Livewire\Admin\Role\Index::class)->name('admin.role');
    Route::get('/setting', \DevHau\Modules\Http\Livewire\Admin\Setting\Index::class)->name('admin.setting');
    Route::get('/schedule', \DevHau\Modules\Http\Livewire\Admin\Schedule\Index::class)->name('admin.schedule');
});
