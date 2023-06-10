 <!-- .page-section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
    <input type="tel" required class="form-control" pattern="[0-9]{8}" name="phone" style="color: black;" placeholder="xxxx xxxx" title="Le numéro de téléphone doit comporter 8 chiffres">
    @error('phone')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


         <div class="col-12 col-sm-6 py-2 wow fadeInRight" required data-wow-delay="300ms">
    <select name="departement" id="departement" required class="custom-select">
        <option disabled selected value="">- Sélectionnez un docteur -</option>
        @foreach($doctor as $doctors)
        <option value="{{$doctors->name}}">{{$doctors->name}} - Specialité - {{$doctors->speciality}}</option>
        @endforeach
    </select>
    @error('departement')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

          <div class="col-12 col-sm-6 py-2 wow fadeInLeft" data-wow-delay="300ms">
    <input type="date" required name="date" class="form-control" id="date-input">
    <div id="date-error" class="alert alert-danger" style="display: none;"></div>
</div>
          
<div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
    <label for="heure">Heure :</label>
    <input type="text" required name="heure" id="heure-picker" class="form-control">
    @error('heure')
        <div class="alert alert-danger">{{ $message }}</div>
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

  <script>
    var dateInput = document.getElementById('date-input');
    var dateError = document.getElementById('date-error');
    
    dateInput.addEventListener('input', function() {
        var selectedDate = new Date(dateInput.value);
        var currentDate = new Date();
        
        if (selectedDate < currentDate) {
            dateError.style.display = 'block';
            dateError.textContent = 'La date doit être postérieure à la date courante.';
        } else {
            dateError.style.display = 'none';
        }
        
        if (selectedDate.getFullYear().toString().length !== 4) {
            dateError.style.display = 'block';
            dateError.textContent = 'L\'année doit comporter 4 chiffres.';
        }
    });
</script>

<script>
    flatpickr("#heure-picker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
</script>

