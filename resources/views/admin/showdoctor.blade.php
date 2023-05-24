<!DOCTYPE html>
<html lang="fr">
  <head>
   @include('admin.css')
  </head>
  <body>
    
<h2>hello test</h2>

         <div class="medecins-liste">
    @foreach ($doctors as $doctor)
        <div class="medecin">
            <h3>{{ $doctor->name }}</h3>
            <p>Téléphone : {{ $doctor->phone }}</p>
            <p>Email : {{ $doctor->email }}</p>
            <p>Spécialité : {{ $doctor->speciality }}</p>
        </div>
    @endforeach
</div>
 
  </body>
</html>