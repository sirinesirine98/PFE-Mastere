<!DOCTYPE html>
<html lang="fr">
  <head>
    <style type="text/css"> 
   label {
        display: inline-block;
        width: 200px;
      }
  
    </style>
   @include('admin.css') 
   </head>
  <body>
     @include('admin.sidebar')

     @include('admin.navbar')
               
     <div class="container" align="center" style="padding-top:100px;">
        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            {{session()->get('message')}}
        </div>

        @endif
        <form action="{{ url('upload_doctor') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div style="padding:15px;">
            <label>Nom du docteur </label>
            <input type="text" required="" name="name" style="color:black;"  placeholder="Nom du docteur">
            </div>
            <div style="padding:15px;">
            <label>Téléphone </label>
            <input type="number" required="" name="phone" style="color:black;"  placeholder="xxxx xxxx">
            </div>

             <div style="padding:15px;">
            <label>Email </label>
            <input type="text" required="" name="email" style="color:black;"  placeholder="email">
            </div>

           
            <div style="padding:15px;">
            <label>Spécialité </label>
            <select style="color:black" name="speciality" required="" id="speciality">
                <option>--Sélectionner--</option>
                <option value="Dermatologie">Dermatologie</option>
                <option value="Psychiatrie">Psychiatrie</option>
                <option value="Radiologie">Radiologie</option>
                <option value="Gynécologie">Gynécologie</option>
                <option value="Biologie">Biologie Médicale</option>
                <option value="Cardiovasculaire">Médecine cardiovasculaire</option>
                <option value="Médecine d’urgence">Médecine d’urgence</option>
            </select>
            </div>
           

            <div style="padding:15px;">
            <input type="submit" class="btn btn-success" >
            </div>
        </form>
    
    </div>

        @include('admin.script')
  </body>
</html>