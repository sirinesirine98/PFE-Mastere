 <!-- .page-section -->

 <div class="page-section" id="appointment">

   <div class="container">
      <h1 class="text-center wow fadeInUp">Demander un RDV</h1>

      <form class="main-form" action="{{url('appointment')}}" method="POST">

        @csrf
        
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" required class="form-control" name="name" placeholder="Votre nom">
             @error('name')
       <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="email" required class="form-control" name="email" placeholder="Votre Email">
            @error('email')
       <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>
           <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="number" required class="form-control" name="phone" style="color:black;"  placeholder="xxxx xxxx">
             @error('phone')
       <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>

          <div class="col-12 col-sm-6 py-2 wow fadeInRight" required data-wow-delay="300ms">
            <select name="departement" id="departement" required class="custom-select">
              <option required>----Selectionner docteur----</option>
             @foreach($doctor as $doctors)
              <option required value="{{$doctors->name}}">{{$doctors->name}} -- Specialité -- {{$doctors->speciality}}</option>
               @endforeach
            </select>
             @error('departement')
       <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>

          <div required class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
            <input type="date" required name="date" min="{{ date('d-m-Y') }}" class="form-control">
             @error('date')
       <div required class="alert alert-danger">{{$message}}</div>
          @enderror
            
          </div>
          
          
          <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
    <label>
        <input type="radio" required name="etat" value="Urgent"> État d'urgence    </label>
    <label>
        <input type="radio" required name="etat" value="Libre"> État consultation libre    </label>
</div>

        <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
  <textarea name="message" required id="message" class="form-control" rows="6" placeholder="Enter votre message.."></textarea>
  @error('message')
    <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>


                <button type="submit" class="btn btn-primary">Envoyer</button>
                

      </form>
    </div>
  </div> <!-- .page-section -->
