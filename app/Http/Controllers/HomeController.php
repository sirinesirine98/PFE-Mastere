<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Documents;


class HomeController extends Controller
{
    public function redirect(){
        if (Auth::id())
        {
            if (Auth::user()-> usertype=='0')
            {
                $doctor = doctor::all();
                return view('user.home' , compact('doctor'));
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

    public function appointment(Request $request)
    {
        $data = new appointment; 
        $data->name=$request->name;
        $data->email=$request->email;
        $data->date=$request->date;
        $data->phone=$request->number;
        $data->message=$request->message;
        $data->doctor=$request->doctor;
        $data->status='En cours';
        if (Auth::id())
        { 
        $data->user_id=Auth::user()->id;
        }
        
        $data->save();
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

