<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;


class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_doctor');
    }

    public function upload(Request $request)
{
    $doctor = new doctor;
    $doctor->name = $request->name;
    $doctor->phone = $request->phone;
    $doctor->email = $request->email;
    $doctor->speciality = $request->speciality;
    $doctor->save();
    return redirect()->back()->with('message','Docteur ajouter avec succées !');
}

     public function liste_rdv()
        {
            $data = appointment::all();
            return view('admin.showappointment' , compact('data'));
        }

            public function Approved($id)
            {
                $data=appointment::find($id);
                $data->status='Approved';
                $data->save();
                return redirect()->back()->with('message','Rendez-vous valider avec succées !');

            }

            public function canceled($id)
            {
                $data=appointment::find($id);
                $data->status='canceled';
                $data->save();
                return redirect()->back()->with('message','Rendez-vous annuler avec succées !');
            }

            public function liste_docteur()
            {
                $data = doctor::all();
                return view ('admin.showdoctor', compact('data'));
            }

            public function supprimer_docteur($id)
            {
                $data=doctor::find($id);
                $data->delete();
                return redirect()->back();
            }

            public function modifier_docteur($id)
            {
                $data = doctor::find($id);
                return  view('admin.updatedoctor' , compact('data'));
            }

            public function editdoctor(Request $request , $id)
            {
                $doctor = doctor::find($id);
                $doctor-> name= $request -> name ;
                $doctor-> phone= $request -> phone ;
                $doctor-> speciality= $request -> speciality ;
                $picture = $request->file;
                 $doctor->save();
                 
                 return redirect()->back()->with('message','Docteur est modifier avec succées !');;

            }

          /*  public function emailview ($id)

            {
                $data=appointment::find($id);
                return view ('admin.email_view' , compact('data'));

            }*/

           /* public function sendemail(Request $request, $id)
            {
                $data = appointment::find($id);
                $details=[
                    'greeting' => $request-> greeting,
                    'body' => $request->body,
                    'action' => $request->action,
                    'url' => $request->url,
                    'end' => $request->end
                ];
            
                Notification::send($data, new SendEmailNotification($details));

                return redirect()->back()->with('message' , 'Email send is successful');

            }*/
}
