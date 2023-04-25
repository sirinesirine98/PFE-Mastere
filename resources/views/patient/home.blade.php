
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
  .page-patient {
  position: relative;
  height: 300px;
  z-index: 10;
  
}


.links ul {
  list-style: none;
  margin: 0;
  padding: 0;
  text-align: center;
}

.links li {
  display: inline-block;
}

.links a {
  color: #000000;
  font-weight: bold;
}

.hello{
  margin-top: 30px;
  text-align: center;
  font-size: 24px;
  font-weight: bold;
}

</style>
<body>
<x-app-layout>

<div class="page-patient bg-image overlay-dark" style="background-image: url(../assets/img/bg_patient.jpg);">

  <div class="links">
    <ul>
    
         <li class="nav-item menu-items">
            <a class="nav-link" href=" ">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Consulter mes documents partagés</span>
            </a>
       </li>
       
        <li class="nav-item menu-items">
            <a class="nav-link" href=" ">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
              <span class="menu-title">Consulter mes comptes rendus</span>
            </a>
       </li>
         
       <li>
        <a class="nav-link" href="/rdvs">
    <span class="menu-icon">
      <i class="mdi mdi-speedometer"></i>
    </span>
    <span class="menu-title">Consulter mes RDV</span>
</a>
       </li>

   </ul>
</div>
</div>
<div class="hello">
  hello
</div>


</x-app-layout>
</body>
</html>