<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>E-Consult</title>

  <link rel="stylesheet" href="../assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/css/theme.css">
</head>
<style>
   
    .rectangle {
    border-radius: 15px 50px;
    background: #D5F5E3;
    padding: 20px; 
    width: 200px;
    height: 150px; 
    float:right;
    } 

.rectangle_first-card {
    border-radius: 15px 50px;
  background: #D5F5E3;
  padding: 20px; 
  width: 100px;
  height: 550px; 

}

.profile_titre {
    font-family: Playfair Display;
  font-weight: bold;
  font-size: 25px;
  text-align: center;
  color: black;
}

nav {
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0,0,0,.1);
  padding: 20px;
}


a {
  text-decoration: none;
  color: #444;
  font-weight: bold;
  font-size: 16px;
  transition: color 0.2s ease-in-out;
}

a:hover {
  color: #007bff;
}

</style>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +216 70 000 000</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> E-Consult@gmail.com</a>
            </div>
          </div>
        
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">E</span>-Consult</a>

        <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Chercher .." aria-label="Username" aria-describedby="icon-addon1">
          </div>
        </form>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
           @if(Route::has('login'))

            @auth
            
            <x-app-layout>
            </x-app-layout>
            @else
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('login')}}">Login </a>
            </li> 
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-3" href="{{route('register')}}">Register </a>
            </li>
            @endauth
            @endif


          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>



<div class="rectangle">
  <p class="profile_titre">Mon profile</p>
 </div>
</div>
<nav>
  <ul>
    <li><a href="#">Accueil</a></li>
    <li><a href="#">A propos</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Blog</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
</nav>

<div class=" rectangle_first-card ">
  <p> kk</p>

</div>
<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
</body>
</html>