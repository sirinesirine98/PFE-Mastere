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


          <div align="center" style="padding:100px;">
                    <table>
                        <tr style="background-color:black;">
                            <th style="padding:10px;text-align:center; color:white">Nom du docteur</th>
                            <th style="padding:10px;text-align:center; color:white">Email</th>
                            <th style="padding:10px;text-align:center; color:white">Téléphone</th>
                            <th style="padding:10px;text-align:center; color:white">Spécialité</th>
                            <th style="padding:10px;text-align:center; color:white">Image</th>
                            <th style="padding:10px;text-align:center; color:white">Supprimer</th>
                            <th style="padding:10px;text-align:center; color:white">Modifier</th>
                        </tr>
                        @foreach($data as $doctor)
                        <tr align="center" style="background-color:#F5F5F5; color:black">
                            <td>{{ $doctor -> name }}</td>
                            <td>{{ $doctor -> email}}</td>
                            <td>{{ $doctor -> phone}}</td>
                            <td>{{ $doctor -> speciality}}</td>
                            <td>{{ $doctor -> image}}</td>
                            <td><a onclick="return confirm('Vous êtes sûre de supprimer le docteur ?') " href="{{ url('supprimer_docteur' , $doctor->id) }}" class="btn btn-danger">Supprimer</a></td>
                            <td><a onclick="return confirm('Vous êtes sûre de modifier le docteur ?') " href="{{ url('modifier_docteur' , $doctor->id) }}" class="btn btn-primary">Modifier</td>
                        </tr>
                        @endforeach
                    </table>
          </div>
     

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</div>
  </body>
</html>