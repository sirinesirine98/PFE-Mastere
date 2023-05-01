<div class="page-section">
    <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp">Nos Docteurs</h1>
      <div class="row mt-5">  
        
    @foreach($doctor as $doctors)
    <div class="col-md-6 col-lg-4 py-3 wow zoomIn">
        <div class="card-doctor">
            <div class="header">
              <img height="300px" src="../assets/img/doctors/doctor_1.jpg" alt="">
                <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                </div>
            </div>
            <div class="body">
                <p class="text-xl mb-0">{{ $doctors->name }}</p>
                <span class="text-sm text-grey">{{ $doctors->speciality }}</span>
            </div>
        </div>
    </div>
@endforeach

          </div>

        </div>
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->
