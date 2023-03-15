<!DOCTYPE html>
<html lang="fr">
  <head>
   @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
     @include('admin.navbar')
        <!-- partial -->

          <div align="center" style="padding-top:100px;">
                    <table>
                        <tr style="background-color:black;">
                            <th style="padding:10px; color:white">Nom du docteur</th>
                            <th style="padding:10px; color:white">Email</th>
                            <th style="padding:10px; color:white">Téléphone</th>
                            <th style="padding:10px; color:white">Sallon</th>
                            <th style="padding:10px; color:white">Spécialité</th>
                            <th style="padding:10px; color:white">Image</th>
                            <th style="padding:10px; color:white">Supprimer</th>
                            <th style="padding:10px; color:white">Modifier</th>
                        </tr>
                        @foreach($data as $doctor)
                        <tr>
                            <td>{{ $doctor -> name }}</td>
                            <td>{{ $doctor -> email}}</td>
                            <td>{{ $doctor -> phone}}</td>
                            <td>{{ $doctor -> room}}</td>
                            <td>{{ $doctor -> speciality}}</td>
                            <td><img src="{{$doctor->picture}}" height="100" ></td>
                            <td><a onclick="return confirm('Vous êtes sûre de supprimer le docteur ?') " href="{{ url('supprimer_docteur' , $doctor->id) }}" class="btn btn-danger">Supprimer</a></td>
                            <td><a onclick="return confirm('Vous êtes sûre de modifier le docteur ?') " href="{{ url('modifier_docteur' , $doctor->id) }}" class="btn btn-primary">Modifier</td>
                        </tr>
                        @endforeach
                    </table>
          </div>
        </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</div>
  </body>
</html>