<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Room;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth ;
class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_doctor');
    }

   public function upload(Request $request)
{
    $doctor = new doctor;

    if ($request->hasFile('image')) { // Check if a file was uploaded
        $image = $request->file('image');


        $imagename = time().'.'.$image->getClientOriginalExtension();

        $image->move('doctorimage', $imagename);

        $doctor->image = $imagename;
    }
    $doctor->name = $request->name;
    $doctor->phone = $request->phone;
    $doctor->email = $request->email;
    $doctor->speciality = $request->speciality;

    $doctor->save();
    return redirect()->back()->with('message','Docteur ajouter avec succées !');
}
/*
public function supprimer($idMedecin)
{
    try {
        $medecin = Medecin::findOrFail($idMedecin);
        $medecin->delete();

        // Retourner une réponse JSON indiquant le succès
        return response()->json(['success' => true]);
    } catch (\Exception $exception) {
        // Retourner une réponse JSON indiquant une erreur
        return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
    }
}
*/

public function liste_rdv()
{
    $rdvs = Appointment::all();
    return response()->json($rdvs);
}

public function liste_rdv_patient()
{
    // Récupérer l'ID du patient connecté
    $patientId = Auth::user()->id;

    // Récupérer les rendez-vous du patient
    $rendezvous = RendezVous::where('patient_id', $patientId)->get();

    return response()->json($rendezvous);
}



         public function liste_patients()
{
    $patients = Patient::all();

    return response()->json($patients);
}




 public function listePatientsApprouves(): JsonResponse
    {
        $patients = Patient::whereHas('appointments', function ($query) {
            $query->where('status', 'Approved');
        })->get();

        return response()->json($patients);
    }
public function listeConsultations()
{
    $consultations = Consultation::where('status', 'Approved')
        ->join('rooms', 'consultation.room_id', '=', 'rooms.id')
        ->select(
            'consultation.id as id_consultation',
            'consultation.date as date_consultation',
            'consultation.time as heure_consultation',
            'rooms.doctor as médecin',
            'rooms.patient as patient'
        )
        ->get();

    return response()->json($consultations);
}

public function listeRendezVous()
{

    $connected_user_email =  Auth::user()->email;
   $appointments = Appointment::where('email','=',$connected_user_email)->get();


   return $appointments;



  /*   $rendezvous = Appointment::join('users', 'appointments.user_id', '=', 'users.id')
        ->join('doctors', 'appointments.doctor', '=', 'doctors.name')
        ->select('users.name', 'users.email', 'appointments.date', 'doctors.name as doctorName', 'appointments.message', 'appointments.status', 'appointments.etat')
        ->get();

    return response()->json($rendezvous); */
}


/*
public function listeRendezVous()
{
    $rendezvous = Appointment::with('user', 'appointment' , 'doctor')->get();

    return response()->json($rendezvous);
}
*/


public function approve($id)
{
    $appointment = Appointment::find($id);
    if ($appointment) {
        $appointment->status = 'Approved';
        $appointment->save();
        return new JsonResponse(['success' => true]);
    } else {
        return new JsonResponse(['success' => false]);
    }
}


public function delete($id)
{
    $appointment = Appointment::find($id);
    if ($appointment) {
        $appointment->delete();
        return new JsonResponse(['success' => true]);
    } else {
        return new JsonResponse(['success' => false]);
    }
}


         public function liste_docteur(Request $request)
{
    $doctors = Doctor::all();
    return response()->json($doctors);
}




            public function supprimer_docteur($id)
            {
                $data=doctor::find($id);
                $data->delete();
                return redirect()->back();
            }

/*public function getMedecin($id)
{
    $medecin = Medecin::find($id);

    if (!$medecin) {
        return response()->json(['error' => 'Médecin non trouvé'], 404);
    }

    return response()->json($medecin);
}*/


public function details_docteur($id)
{
    $doctor = Doctor::find($id);
    return response()->json($doctor);
}


public function modifier_docteur($id, Request $request) {

    $doctor = Doctor::find($id);

    if ($doctor) {
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->speciality = $request->speciality;
        $doctor->save();

        return new JsonResponse(['success' => true]);
    }

    return new JsonResponse(['success' => false, "msg" => "Doctor not found"]);
}

public function fichePatient($id) {
    $apt = Appointment::find($id);
    $patient_email = $apt->email;
    $patient  = Patient::where('email', '=', $patient_email)->first();



    return $patient;
}

}
