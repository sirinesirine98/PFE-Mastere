<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\DemandeurRdv;
use App\Models\Documents;
use App\Http\Requests\ArRequest;
use Illuminate\Support\Facades\Validator;
//use App\Mail\AppointmentApproved;
use Illuminate\Support\Facades\Mail;
use App\Events\AppointmentApproved;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;


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



/*
   public function appointment(Request $request)
{
    $data = new Appointment; 
    $data->name=$request->name;
    $data->email=$request->email;
    $data->date=$request->date;
    $data->phone=$request->number;
    $data->message=$request->message;
    $data->doctor=$request->doctor;
    $data->status='En cours';
    if (Auth::id()) { 
        $data->user_id=Auth::user()->id;
    }
    $data->save();

     $demandeurRdv = new DemandeurRdv;
    $demandeurRdv->name_user =$request -> name_user;
    $demandeurRdv->email_user = $request->email;
    $demandeurRdv->telephone_user = $request->number;
    $demandeurRdv->nom_medecin = $request->name ;
    $demandeurRdv->date_rdv = $request->date;
    $demandeurRdv->heure_rdv = $request->time;
    $demandeurRdv->message = $request->message;
    $demandeurRdv->etat = $request->etat;
    $demandeurRdv->save();

    // Call the updatePatientTable function after saving the appointment
    return redirect()->back()->with('message','Rendez-vous ajouté avec succès ! Vérifier votre boite Email pour avoir la réponse de votre demande :)');
}*/

public function submitAppointment(Request $request) {
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'departement' => 'required',
        'date' => 'required|date',
        'heure' => 'required',
        'etat' => 'required',
        'message' => 'required',
    ]);

    $appointment = new Appointment;
    $appointment->name = $validatedData['name'];
    $appointment->email = $validatedData['email'];
    $appointment->phone = $validatedData['phone'];
    $appointment->doctor = $validatedData['departement'];
    $appointment->date = $validatedData['date'];
    $appointment->message = $validatedData['message'];
    $appointment->status = 'En cours';
    $appointment->etat = $validatedData['etat'];
    $appointment->save();

    $demandeurRdv = new DemandeurRdv;
    $demandeurRdv->name_user = $request -> name;
    $demandeurRdv->email_user = $request->email;
    $demandeurRdv->telephone_user = $request->phone;
    $demandeurRdv->nom_medecin = $request->name;
    $demandeurRdv->date_rdv = $request->date;
    $demandeurRdv->heure_rdv = $request->time;
    $demandeurRdv->message = $request->message;
    $demandeurRdv->etat = $request->etat;
    $demandeurRdv->save();



    return redirect()->back()->with('message','Rendez-vous ajouté avec succès ! ');

}


public function appointmentApproved(Request $request, $id)
{
    
    
   $data = Appointment::find($id);
 if ($data ) {
        $data->status = 'Approved';
        $data->save();

      $patient = new Patient;
        $patient->nomdenaissance = $data->name;
        $patient->prenom = $data->name;
        $patient->datedenaissance = $data->date;
        $patient->ville = $data->name;
        $patient->email = $data ->email;
        $patient->telephone = $data->phone;
        $patient->save() ;

        return response([
            "success" => true
        ], 200);
          //return redirect()->back()->with('message', 'Rendez-vous ajouté avec succès ! Vérifiez votre boîte e-mail :)');
        

}
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

         public function getPatientAppointments($nom)
{
    $patient = Patient::where('nomdenaissance', $nom)->first();

    if (!$patient) {
        // Gérer le cas où aucun patient n'est trouvé avec ce nom
        return response()->json(['message' => 'Patient introuvable'], 404);
    }

    $appointments = $patient->appointments;

    return response()->json($appointments);
}

     

}




