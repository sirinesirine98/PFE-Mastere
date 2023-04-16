 <!-- .page-section -->

 <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Demander un RDV</h1>

      <form class="main-form" action="{{url('appointment')}}" method="POST">

        @csrf
        
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" class="form-control" name="name" placeholder="Votre nom">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" class="form-control" name="email" placeholder="Votre Email">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="date" name="date" class="form-control">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
            <select name="departement" id="departement" class="custom-select">
              <option>----Selectionner docteur----</option>
             @foreach($doctor as $doctors)
              <option value="{{$doctors->name}}">{{$doctors->name}} -- Specialité -- {{$doctors->speciality}}</option>
               @endforeach
            </select>
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <input type="text" name="etat" class="form-control" placeholder="État de RDV..">
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter votre message.."></textarea>
          </div>
        </div>
                <button  class="btn btn-primary">Envoyer</button>

      </form>
    </div>
  </div> <!-- .page-section -->
