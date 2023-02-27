<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class AdminController extends Controller
{
    public function addview()
    {
        return view('admin.add_doctor');
    }

    public function upload(Request $request)
{
    $doctor = new doctor;

    if ($request->hasFile('file')) { // Check if a file was uploaded
        $image = $request->file('file');
        $imagename = time().'.'.$image->getClientOriginalExtension();

        $image->move('doctorimage', $imagename);

        $doctor->image = $imagename;
    }

    $doctor->name = $request->name;
    $doctor->phone = $request->phone;
    $doctor->room = $request->room;
    $doctor->speciality = $request->speciality;
    $doctor->save();

    return redirect()->back()->with('message','Docteur ajouter avec succées !');
}

}
