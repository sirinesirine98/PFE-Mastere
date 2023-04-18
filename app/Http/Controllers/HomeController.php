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
            if (Auth::user()-> usertype=='isPatient')
            {
                //$doctor = doctor::all();
                return view('patient.home' );
            }
            else  {
                return view('admin.home');

            }
           
        }
         if (Auth::user()-> usertype=='1') {
                return view('medecin.home');

            }
        else {
            return redirect()->back();
        }
    }

    public function index(){
         if (Auth::id())
         { return redirect('home');}
        else 
            {
        $doctor = doctor::all();
        return view('user.home' , compact('doctor'));
            }
    }

    public function appointment(ArRequest $request)
    {
         //$validator = $request->validated();
        $validator = Validator::make($request->all(), [
            "name"=>"required|max:25" ,
            "email" => "required|email|unique:users,email|max:255",
            "phone" => "required|digits:8",
            "date" => "required|date",
            "message" => "required",
        ]);
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator);
        }


       $appointment = new appointment; 
        /*$appointment->name = $validatedData['name'];
    $appointment->email = $validatedData['email'];
    $appointment->phone = $validatedData['phone'];
    $appointment->date = $validatedData['date'];
    $appointment->message = $validatedData['message'];
    $appointment->doctor = $validatedData['doctor'];*/
   $appointment->name = $request->input('name');
$appointment->email = $request->input('email');
$appointment->phone = $request->input('phone');
$appointment->date = $request->input('date');
$appointment->message = $request->input('message');
$appointment->doctor = $request->input('doctor');

    
        /*Appointment::create($request->validated() );*/

        $appointment->status='En cours';

        if (Auth::id())
        { 
        $appointment->user_id=Auth::user()->id;
        }
        
        $appointment->save();
     return redirect()->back()->with('message','Rendez-vous ajouter avec succées !');

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

