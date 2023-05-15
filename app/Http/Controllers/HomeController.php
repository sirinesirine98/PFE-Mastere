<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Documents;
use App\Http\Requests\ArRequest;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function redirect(){
        if (Auth::id())
        {
            $doctor = doctor::all();
            if (Auth::user()-> usertype=='patient')
            {
                
                return view('patient.home');
            }
            else if (Auth::user()-> usertype=='medecin') {
                return view('medecin.home');
            }
            else {
                return view('admin.home');
            }
           
        }
        
    }

    public function index()
    {
         if (Auth::id())
         { return redirect('home');}
        else 
            {

        $doctor = doctor::all();
        return view('user.home' , compact('doctor'));
      }
    }

  public function appointment(Request $request)
{
    $appointment = new appointment; 
    $appointment->name = $request->name;
    $appointment->email = $request->email;
    $appointment->phone = $request->phone;
    $appointment->date = $request->date;
    $appointment->message = $request->message;
    $appointment->doctor = $request->departement;
    $appointment->etat = $request->etat;
    $appointment->status='En cours';

    if (Auth::id()) { 
        $appointment->user_id=Auth::user()->id;
    }
        
    $appointment->save();

    //envoyer une notif au user 
    if (Auth::check()) {
        $user = Auth::user();
        $user->notify(new AppointmentRequestNotification($appointment));
    }
        
    if ($appointment->status == 'approved') {
        $patient = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,

            'password' => Hash::make('password'),
            'usertype' => 'patient',
        ]);
        
        $patient->save();
    }

    return redirect()->back()->with('message','Rendez-vous ajouté avec succès ! Vérifier votre boite Email pour avoir la réponse de votre demande :)');
}


    public function myappointment()
    {
       if(Auth::id())
       {
            $userid=Auth::user()->id;
            $appoint=appointment::where('user_id',$userid )->get();
          return view ('user.my_appointment' , compact('appoint'));
       }
       else 
       {
         return redirect()->back();
       }
    }

       

         public function cancel_appointment($id)
         {
          $data=appointment::find($id);
          $data->delete();
          return redirect()-> back();


         }
    
      /*    public function mes_documents()
        {
            $data = new mes_documents;
            $data->name=$request->name;
            $data->date=$request->date;
            $data->status=$request->status;
            $data->diagnostic=$request->diagnostic;
            $data->resultat=$request->resultat;
         if (Auth::id())
        { 
        $data->user_id=Auth::user()->id;
        $data->doctor_id=Auth::doctor()->id;
        }
                    $data->save();
     return redirect()->back()->with('message','Rendez-vous ajouter avec succées !');

        }*/

         public function mydocs()
         {
            return view ('user.mydocs' );

         }
     

}




