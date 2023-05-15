<!DOCTYPE html>
<html lang="fr">
  <head>
    <base href="/public">
    <style type="text/css">
      label {
        display: inline-block;
        width: 200px;
      }
    </style>
       @include('admin.css')

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
     @include('admin.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

         

         <div class="container" align="center" style="padding:100px"> 

         
           @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert"></button>
            {{session()->get('message')}}
        </div>

        @endif

         <form action="{{ url('editdoctor' , $data->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div style="padding:15px;">
            <label>Nom du docteur </label>
            <input type="text" style="color:black;" name="name" value="{{$data->name}}">
          </div>

           <div style="padding:15px;">
            <label>Téléphone du docteur </label>
            <input type="number" name="phone" style="color:black;"  value="{{$data->phone}}">
          </div>

           <div style="padding:15px;">
            <label>Spécialité du docteur </label>
            <input type="text" name="speciality" style="color:black;"  value="{{$data->speciality}}">
          </div>

          <div style="padding:15px;">
          <input type="submit" class="btn btn-primary">
          </div>

         </form>

         </div>
       

        </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</div>
  </body>
</html>