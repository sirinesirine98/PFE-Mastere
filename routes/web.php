<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;

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


Route::get('/', [HomeController::class , 'index']);

Route::get('/home', [HomeController::class , 'redirect']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view', [AdminController::class ,'addview']);
Route::post('/upload_doctor', [AdminController::class , 'upload']);


Route::post('/appointment', [HomeController::class , 'appointment']);
Route::get('/myappointment', [HomeController::class , 'myappointment']);
Route::get('/cancel_appointment/{id}', [HomeController::class , 'cancel_appointment']);
Route::get('/liste_rdv', [AdminController::class , 'liste_rdv']);
Route::get('/Approved/{id}', [AdminController::class , 'Approved']);
Route::get('/canceled/{id}', [AdminController::class , 'canceled']);


Route::get('/liste_docteur', [AdminController::class , 'liste_docteur']);


Route::get('/supprimer_docteur/{id}', [AdminController::class , 'supprimer_docteur']);
Route::get('/modifier_docteur/{id}', [AdminController::class , 'modifier_docteur']);


Route::post('/editdoctor/{id}', [AdminController::class , 'editdoctor']);


Route::get('/mydocs',function(){
    return view('user.mydocs');
    });


Route::get('/rdv', [HomeController::class , 'rdv_view'])->name('rdv');


//Route::get('/priserdv', [HomeController::class, 'showAppoinForm'])->name('priserdv');
Route::get('notification',[NotificationController::class , 'sendNotification']);