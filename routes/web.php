<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\RoleMenuAccessController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

    // User Management
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('users.show');
        Route::delete('//destroy{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Role Management
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/update/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/show/{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::delete('/destroy/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        Route::post('/updateMenuAccess', [RoleController::class, 'updateMenuAccess'])->name('roles.updateMenuAccess');
    });

    // Menu Management
    Route::group(['prefix' => 'menus'], function () {
        Route::get('/', [MenuController::class, 'index'])->name('menus.index');
        Route::get('/create', [MenuController::class, 'create'])->name('menus.create');
        Route::post('/store', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('menus.edit');
        Route::put('/update/{menu}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/destroy/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
        Route::get('/show/{menu}', [MenuController::class, 'show'])->name('menus.show');
    });

    // Submenu Management
    Route::group(['prefix' => 'submenus'], function () {
        Route::get('/', [SubmenuController::class, 'index'])->name('submenus.index');
        Route::get('/create', [SubmenuController::class, 'create'])->name('submenus.create');
        Route::post('/store', [SubmenuController::class, 'store'])->name('submenus.store');
        Route::get('/edit/{submenu}', [SubmenuController::class, 'edit'])->name('submenus.edit');
        Route::put('/update/{submenu}', [SubmenuController::class, 'update'])->name('submenus.update');
        Route::delete('/destroy/{submenu}', [SubmenuController::class, 'destroy'])->name('submenus.destroy');
        Route::get('/show/{submenu}', [SubmenuController::class, 'show'])->name('submenus.show');
    });


    // Role Menu Access Management
    Route::group(['prefix' => 'role-menu-accesses'], function () {
        Route::get('/', [RoleMenuAccessController::class, 'index'])->name('role_menu_accesses.index');
        Route::get('/create', [SubmenuController::class, 'create'])->name('role_menu_accesses.create');
        Route::post('/store', [SubmenuController::class, 'store'])->name('role_menu_accesses.store');
        Route::get('/edit/{submenu}', [SubmenuController::class, 'edit'])->name('role_menu_accesses.edit');
        Route::put('/update/{submenu}', [SubmenuController::class, 'update'])->name('role_menu_accesses.update');
        Route::delete('/destroy/{submenu}', [SubmenuController::class, 'destroy'])->name('role_menu_accesses.destroy');
        Route::get('/show/{submenu}', [SubmenuController::class, 'show'])->name('role_menu_accesses.show');
    });

    // Default Route
    Route::group(['prefix' => '/'], function () {
        Route::get('/', [MainController::class, 'index'])->name('main.index');
        Route::get('/dashboard', [MainController::class, 'index'])->name('main.index');
    });
});
// Authentication Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/sign-out', [LoginController::class, 'logout'])->name('sign-out');
