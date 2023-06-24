<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Models\Patient;
use Dompdf\Dompdf;




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


Route::post('/appointment', [HomeController::class , 'submitAppointment']);
Route::post('/appointment/approve/{id}/{doctor}', [HomeController::class, 'appointmentApproved'])->name('appointment.approve');

Route::get('/myappointment', [HomeController::class , 'myappointment']);
Route::get('/cancel_appointment/{id}', [HomeController::class , 'cancel_appointment']);
Route::get('/liste_rdv', [AdminController::class , 'liste_rdv']);

//Route::get('/Approved/{id}', [AdminController::class , 'Approved']);
//Route::post('/appointment/approve/{id}', [AdminController::class , 'approve']);
Route::delete('/appointment/delete/{id}', [AdminController::class , 'delete']);

Route::post('/appointment/reject/{idRdv}', [HomeController::class, 'reject'])
    ->name('appointment.reject');

//Route::get('/canceled/{id}', [AdminController::class , 'canceled']);

Route::post('/doctor/supprimer/{idDoctor}', [HomeController::class, 'supprimer'])
    ->name('doctor.supprimer');

Route::get('/liste_patients', [AdminController::class, 'liste_patients']);

Route::get('/details_docteur/{id}', 'AdminController@details_docteur');


Route::get('/listePatientsApprouves', [AdminController::class, 'listePatientsApprouves']);

Route::get('/listeConsultations', [AdminController::class, 'listeConsultations']);

//Route::get('/liste_docteur', [AdminController::class , 'liste_docteur']);

Route::get('/liste_docteur', [AdminController::class, 'liste_docteur'])->name('liste_docteur');
Route::post('/ajouter_medecin', [AdminController::class, 'ajouter_medecin'])->name('ajouter_medecin');


Route::get('/supprimer_docteur/{id}', [AdminController::class , 'supprimer_docteur']);

Route::get('/medecin/{id}', 'AdminController@getMedecin');

Route::post('/medecin/supprimer/{idMedecin}', [AdminController::class, 'supprimer_docteur']);


Route::post('/editdoctor/{id}', [AdminController::class , 'editdoctor']);


Route::get('/mydocs',function(){
    return view('user.mydocs');
    });


//Route::get('/rdv', [HomeController::class , 'rdv_view'])->name('rdv');


//Route::get('/priserdv', [HomeController::class, 'showAppoinForm'])->name('priserdv');



Route::get('/test-notification', [NotificationController::class, 'sendNotification']);


Route::get('/agenda', 'AdminController@agenda')->name('doctor.agenda');



Route::get('/mes_rendezvous', [HomeController::class, 'getRendezvousByEmail']);


//Route::get('/listeRendezVous', [AdminController::class, 'listeRendezVous']);

Route::get('/listeRendezVous', [AdminController::class, 'listeRendezVous']);
Route::get('/liste_rdv_medecin', [AdminController::class, 'liste_rdv_medecin']);



 Route::get('/patient/{id}', [AdminController::class, 'fichePatient']);
Route::get('/files', [AdminController::class, 'fichierspartagees']);
Route::get('/generate-pdf', function () {
    $dompdf = new Dompdf();
    $dompdf->loadHtml('<h1>Mon contenu PDF</h1>');
    $dompdf->render();
    $dompdf->stream('mon_fichier.pdf');
});


Route::post('/documents-partages', 'AdminController@storefiles');

Route::get('/notifications', [NotificationController::class, 'index']);
