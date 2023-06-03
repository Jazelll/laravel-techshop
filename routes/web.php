<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// FOR USER routes
Route::middleware(['user', 'verified'])->group(function () {
    Route::match(['get', 'post'], '/home', [UserController::class, 'index'])->name('user.home');
});

// FOR ADMIN routes
Route::middleware(['admin', 'verified'])->group(function () {

    Route::match(['get', 'post'], '/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::patch('/users/{user}/deactivate', [AdminController::class, 'deactivateUser'])->name('admin.users.deactivate');
    Route::patch('/users/{user}/activate', [AdminController::class, 'activateUser'])->name('admin.users.activate');
    Route::get('/admin/search/users', [AdminController::class, 'search'])->name('admin.search.users');
    Route::get('/admin/search/products', [AdminController::class, 'search'])->name('admin.search.products');

});


// FOR PRODUCTS routes
Route::get('/products', [HomeController::class, 'index'])->name('index'); //LIST OF PRODUCTS
Route::match(['get', 'post'], '/product/create',[HomeController::class, 'create'])->middleware('auth')->name('create'); //CREATE PRODUCTS FORM
Route::get('/product/search',[HomeController::class, 'search'])->name('search'); //SEARCH BAR FOR PRODUCTS
Route::get('/product/{item}', [HomeController::class, 'show']); //SHOW SINGLE PRODUCT
Route::get('/products/edit/{item}', [HomeController::class, 'edit'])->middleware('auth'); //EDIT
Route::post('/product', [HomeController::class, 'store'])->middleware('auth')->name('store'); //save new product
Route::put('/products/{item}', [HomeController::class, 'update'])->middleware('auth'); //update
Route::match(['get','put', 'post'], '/products/manage', [HomeController::class, 'manage'])->middleware('auth')->name('manage'); //manage
Route::get('/products/delete/{item}', [HomeController::class, 'destroy'])->middleware('auth'); //delete



























// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// //List of user routes
// Route::middleware(['user'])->group(function(){
//     Route::get('/home', [UserController::class, 'index'])->name('user.home');
//     //other routes for any user type
// });

// Route::middleware(['admin'])->group(function(){
//     Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//     //other routes for admin only
// });

// //FOR PRODUCT CONTROLLER ---------------------------------------------------------------------------------------

// Route::get('/index', [HomeController::class, 'index']); //show products

// Route::get('/product/create',[HomeController::class, 'create'])->middleware('auth'); //show create form

// Route::get('/product/search',[HomeController::class, 'search'])->name('search'); //search

// Route::get('/product/{item}', [HomeController::class, 'show']); //show single product, //model-route binding

// Route::get('/products/edit/{item}', [HomeController::class, 'edit'])->middleware('auth'); //edit

// Route::post('/product', [HomeController::class, 'store'])->middleware('auth'); //save new product

// Route::put('/products/{item}', [HomeController::class, 'update'])->middleware('auth'); //update

// Route::get('/products/manage', [HomeController::class, 'manage'])->middleware('auth'); //manage

// Route::get('/products/delete/{item}', [HomeController::class, 'destroy'])->middleware('auth'); //delete


// //FOR PRODUCT CONTROLLER ---------------------------------------------------------------------------------------

// // Route::match(['get', 'post'], '/register', [UserController::class, 'create'])->middleware('guest'); //user registration

// Route::post('/users', [UserController::class, 'store'])->middleware('guest'); //save new user

// // Route::post('/logout', [UserController::class, 'logout'])->middleware('auth'); //logout

// // Route::get('/login', [UserController::class, 'login'])->middleware('guest'); //login

// Route::post('/users/authenticate', [UserController::class, 'authenticate']); //authenticate login
