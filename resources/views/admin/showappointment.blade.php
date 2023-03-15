<!DOCTYPE html>
<html lang="fr">
  <head>
    
        @include('admin.css')

  </head>
  <body>
    
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
     @include('admin.navbar')
        <!-- partial -->
                <div align="center" style="padding:100px;">
                    <table>
                        <tr style="background-color:black;">
                            <th style="padding:10px; color:white">Nom du patient</th>
                            <th style="padding:10px; color:white">Email</th>
                            <th style="padding:10px; color:white">Téléphone</th>
                            <th style="padding:10px; color:white">Nom du docteur</th>
                            <th style="padding:10px; color:white">Date</th>
                            <th style="padding:10px; color:white">Message</th>
                            <th style="padding:10px; color:white">Status</th>
                            <th style="padding:10px; color:white">Valider</th>
                            <th style="padding:10px; color:white">Annuler</th>
                        </tr>
                        @foreach($data as $appoint)
                        <tr align="center" style="background-color:skyblue;">
                            <td>{{$appoint-> name }}</td>
                            <td>{{$appoint-> email}}</td>
                            <td>{{$appoint-> phone }}</td>
                            <td>{{$appoint-> doctor}}</td>
                            <td>{{$appoint-> date}}</td>
                            <td>{{$appoint-> message }}</td>
                            <td>{{$appoint-> status}}</td>
                            <td><a class="btn btn-success" href="{{url('approved' , $appoint->id)}}">Valider</a></td>
                            <td><a class="btn btn-danger" href="{{url('canceled' , $appoint->id)}}">Annuler</a></td>
                        </tr>
                        @endforeach
                    </table>

                </div>   
           

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>