<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\JsonResponse;

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


     public function Approved($id)
{
    $data = Appointment::find($id);
    if ($data) {
        $data->status = 'Approved';
        $data->save();

        // Ajouter le demandeur de rendez-vous à la table "patients"
        $patient = new Patient;
        $patient->nomdenaissance = $data->name;
        // Ajoutez d'autres champs du formulaire rempli ici
        $patient->save();

        return redirect()->back()->with('message', 'Rendez-vous approuvé avec succès !');
    } else {
        return redirect()->back()->with('error', 'Rendez-vous non trouvé.');
    }
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
    $consultations = Consultation::where('status', 'Approved')->get();

    return response()->json($consultations);
}


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


           public function editdoctor(Request $request, $id)
{
    $doctor = Doctor::find($id);
    $doctor->name = $request->name;
    $doctor->phone = $request->phone;
    $doctor->speciality = $request->speciality;
    $doctor->save();

    return redirect()->back()->with('message', 'Médecin modifié avec succès !');
}

public function details_docteur($id)
{
    $doctor = Doctor::find($id);
    return response()->json($doctor);
}

         
          
}
