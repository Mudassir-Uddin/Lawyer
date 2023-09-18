<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\dashboard;
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




//____________ Authentication _____________________
#region Auth
    Route::get('/register', [AuthenticationController::class,'register']);
    Route::post('/registerstore', [AuthenticationController::class,'registerstore']);
    Route::get('/login', [AuthenticationController::class,'login']);
    Route::post('/loginstore', [AuthenticationController::class,'loginstore']);
    Route::get('/logout', [AuthenticationController::class,'logout']);
    Route::get('/update', [AuthenticationController::class,'update']);
#endregion


//____________ Home _____________________
#region Home
Route::get('/layout/index', [HomeController::class,'index']);
Route::get('/', [HomeController::class,'Home'])->name('home');
Route::get('/lawyers', [HomeController::class,'lawyers'])->middleware('login')->name('lawyers');
Route::get('/services', [HomeController::class,'services'])->middleware('login')->name('service');
Route::get('/about', [HomeController::class,'about'])->middleware('login')->name('about');
Route::get('/contact', [HomeController::class,'contact'])->middleware('login')->name('contact');
Route::get('/lawyer_details/{id}', [HomeController::class,'lawyer_details'])->middleware('login');

Route::get('/Appoinment/{id}', [HomeController::class,'Appoinment'])->middleware('login')->name('Appoinment');
Route::get('/Appoinment_Details', [HomeController::class,'Appoinment_Details'])->middleware('login')->name('Appoinment_Details');
Route::post('/AppointmentPost/{lawyerId}', [HomeController::class,'AppointmentPost'])->middleware('login')->name('AppointmentPost');

Route::post('/AppointmentConfirm/{id}', [HomeController::class,'Appoinment_Confirm'])->middleware('login')->name('AppointmentConfirm');

// Route::get('/portfolio', [HomeController::class,'portfolio'])->middleware('login');
// Route::get('/blog', [HomeController::class,'blog'])->middleware('login');
// Route::get('/single', [HomeController::class,'single'])->middleware('login');


#endregion




//____________ 


Route::get('/dashboard/Admindashboard', [dashboardController::class,'dashboard'])->middleware('admin');

// service
Route::get('/dashboard/Services_index', [dashboardController::class,'index'])->middleware('staff');
Route::get('/dashboard/Service_insert', [dashboardController::class,'insert'])->middleware('staff');
Route::post('/dashboard/Service_Store', [dashboardController::class,'Store'])->middleware('staff');
Route::get('/dashboard/Service_edit/{id}', [dashboardController::class,'edit'])->middleware('staff');
Route::post('/dashboard/update/{id}', [dashboardController::class,'update'])->middleware('staff');
Route::get('/dashboard/delete/{id}', [dashboardController::class,'delete'])->middleware('admin');

Route::get('/dashboard/Lawyers_index', [dashboardController::class,'Lawyerindex'])->middleware('staff');
Route::get('/dashboard/Lawyers/Sorting/{id}', [dashboardController::class,'sorting'])->middleware('staff');






#region User a
Route::get('/dashboard/User_index', [UserController::class,'index'])->middleware('staff');
Route::get('/dashboard/User/Sorting/{id}', [UserController::class,'sorting'])->middleware('staff');

Route::get('/dashboard/Users_insert', [UserController::class,'insert'])->middleware('staff');
Route::post('/dashboard/Store', [UserController::class,'Store'])->middleware('staff');

Route::get('/dashboard/Users_edit/{id}', [UserController::class,'edit'])->middleware('staff');
Route::post('/dashboard/User_update/{id}', [UserController::class,'update'])->middleware('staff');

Route::get('/dashboard/U_delete/{id}', [UserController::class,'delete'])->middleware('staff');

Route::get('/website/Profile_edit', [HomeController::class,'edit']);
Route::post('/website/Profile_edit/{id}', [HomeController::class,'editPost'])->name('userProfilePost');





