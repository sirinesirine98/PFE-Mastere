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
                            <th style="padding:10px;text-align:center; color:white">Nom du patient</th>
                            <th style="padding:10px;text-align:center; color:white">Email</th>
                            <th style="padding:10px;text-align:center; color:white">Téléphone</th>
                            <th style="padding:10px;text-align:center; color:white">Nom du docteur</th>
                            <th style="padding:10px;text-align:center; color:white">Date</th>
                            <th style="padding:10px;text-align:center; color:white">Message</th>
                            <th style="padding:10px;text-align:center; color:white">Status</th>
                            <th style="padding:10px;text-align:center; color:white">Valider</th>
                            <th style="padding:10px;text-align:center; color:white">Annuler</th>
                        </tr>
                        @foreach($data as $appoint)
                        <tr align="center" style="background-color:#F5F5F5; color:black">
                            <td>{{$appoint-> name }}</td>
                            <td>{{$appoint-> email}}</td>
                            <td>{{$appoint-> phone }}</td>
                            <td>{{$appoint-> doctor}}</td>
                            <td>{{$appoint-> date}}</td>
                            <td>{{$appoint-> message }}</td>
                            <td>{{$appoint-> status}}</td>
                            <td><a class="btn btn-success" href="{{url('Approved' , $appoint->id)}}">Valider</a></td>
                            <td><a class="btn btn-danger" href="{{url('canceled' , $appoint->id)}}">Annuler</a></td>
 </tr>
                        @endforeach
                    </table>

                </div>   
</div>


    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
 </div> </body>
</html>