<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\GroupUse;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class,'index']);

Route::get('/dashboard/Admindashboard', [ServiceController::class,'dashboard'])->middleware('admin');

    // User 
    
Route::get('/dashboard/User_index', [UserController::class,'index'])->middleware('staff');
Route::get('/dashboard/Users_insert', [UserController::class,'insert'])->middleware('staff');
Route::post('/dashboard/Store', [UserController::class,'Store'])->middleware('staff');
Route::get('/dashboard/Users_edit/{id}', [UserController::class,'edit'])->middleware('staff');
Route::post('/dashboard/User_update/{id}', [UserController::class,'update'])->middleware('staff');
Route::get('/dashboard/delete/{id}', [UserController::class,'delete'])->middleware('staff');

Route::get('/website/Profile_edit', [UserController::class,'edit']);


// Category 
Route::get('/dashboard/Services_index', [ServiceController::class,'index'])->middleware('staff');
Route::get('/dashboard/Service_insert', [ServiceController::class,'insert'])->middleware('staff');
Route::post('/dashboard/Store', [ServiceController::class,'Store'])->middleware('staff');
Route::get('/dashboard/Service_edit/{id}', [ServiceController::class,'edit'])->middleware('staff');
Route::post('/dashboard/update/{id}', [ServiceController::class,'update'])->middleware('staff');
Route::get('/dashboard/delete/{id}', [ServiceController::class,'delete'])->middleware('admin');

// WEBSITE 
Route::get('/layout/index', [HomeController::class,'index'])->middleware('login');
Route::get('/Home', [HomeController::class,'Home']);
Route::get('/lawyers', [HomeController::class,'lawyers'])->middleware('login');
Route::get('/lawyer_edit', [HomeController::class,'lawyers'])->middleware('login');
Route::get('/services', [HomeController::class,'services'])->middleware('login');
Route::get('/about', [HomeController::class,'about'])->middleware('login');
Route::get('/contact', [HomeController::class,'contact'])->middleware('login');
Route::get('/lawyer_details/{id}', [HomeController::class,'lawyer_details'])->middleware('login');
// Route::get('/portfolio', [HomeController::class,'portfolio'])->middleware('login');
// Route::get('/blog', [HomeController::class,'blog'])->middleware('login');
// Route::get('/single', [HomeController::class,'single'])->middleware('login');

// Authentication 

Route::get('/register', [AuthenticationController::class,'register']);
Route::post('/registerstore', [AuthenticationController::class,'registerstore']);
Route::get('/login', [AuthenticationController::class,'login']);
Route::post('/loginstore', [AuthenticationController::class,'loginstore']);
Route::get('/logout', [AuthenticationController::class,'logout']);
Route::get('/update', [AuthenticationController::class,'update']);



