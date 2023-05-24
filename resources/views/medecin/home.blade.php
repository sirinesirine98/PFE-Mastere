<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>E-Consult</title>
</head>
<body>
    <div class="side-menu">
      
        <div class="brand-name">
            <h1>Menu</h1>
        </div>
       

        <ul>
  <li><a href="#" id="lien-rendezvous">Liste des rendez-vous</a></li>
  <li><a href="#" id="lien-patients">Patients</a></li>
  <li><a href="#" id="lien-parametres">Paramètres</a></li>
</ul>

    </div>
    <div class="container">
       
     <div class="header">
         
            <div class="nav">
                
                <div class="search">
                    <input type="text" placeholder="Search.." >
                    <button type="submit">

                    </button>
                </div>   
                
                 <div class="">
                    <button type="submit">Join  </button>
                </div>  

                  <x-app-layout>
                  </x-app-layout>
                    </div>
        </div>
        <div class="content">
            <div class="cards"></div>
            <div class="content-2">
                <div class="liste-patients">
                    <div class="title">
                        <h2>Liste des ...</h2>
                        <a href="#" class="btn">Afficher</a>
                    </div>
                    <table>
                        <tr>
                            <th>IPP</th>
                            <th>Name</th>
                            <th>Birthday date</th>
                            <th>Result</th>
                            <th>Options</th>


                        </tr>
                        <tr>
                            <td>aa</td>
                            <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                         
                            <td><a href="#" class="btn">Consulter</a></td>
                        </tr>
                        <tr>
                             <td>aa</td>
                             <td>aa</td> <td>aa</td> <td>aa</td>
                            <td><a href="#" class="btn">Consulter</a></td>
                        </tr>
                       
                       
                    </table>
                </div>
                <div class="historique">
                    <div class="title">
                        <h2>Historique</h2>
                        <a href="#" class="btn">Afficher</a>
                    </div>
                    <table>
                        <tr>
                            <th>Fichier partager</th>
                            <th>Compte rendu</th>
                            <th>Images</th>
                        </tr>
                        <tr>
                            <td><img src="user.png" alt=""></td>
                            <td>aa</td>
                            <td><img src="info.png" alt=""></td>
                        </tr>
                        <tr>
                            <td><img src="user.png" alt=""></td>
                            <td>aa</td>
                            <td><img src="info.png" alt=""></td>
                        
                        
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Récupérer les éléments HTML nécessaires
const lienRendezVous = document.getElementById('lien-rendezvous');
const lienPatients = document.getElementById('lien-patients');
const lienParametres = document.getElementById('lien-parametres');
const contenu = document.querySelector('.content');

// Ajouter un gestionnaire d'événements de clic sur chaque lien de navigation
lienRendezVous.addEventListener('click', afficherRendezVous);
lienPatients.addEventListener('click', afficherPatients);
lienParametres.addEventListener('click', afficherParametres);

// Fonction pour afficher le contenu de la section Rendez-vous
function afficherRendezVous() {
  contenu.innerHTML = `
     
   <div class="content">
            <div class="cards"></div>
            <div class="content-2">
                <div class="liste-patients">
                    <div class="title">
                        <h2>Les Rendez-Vous</h2>
                      
                    </div>
                  
                </div>
           </div>
        </div>
  
  `;
}

// Fonction pour afficher le contenu de la section Patients
function afficherPatients() {
  contenu.innerHTML = `
    
   <div class="content">
            <div class="cards"></div>
            <div class="content-2">
                <div class="liste-patients">
                    <div class="title">
                        <h2>Liste des patients</h2>
                      
                    </div>
                    <table>
                        <tr>
                       
                            <th>IPP</th>
                            <th>NOM</th>
                            <th>PRÉNOM</th>
                            <th>DATE DE NAISSANCE</th>
                            <th>VILLE</th>
                            <th>TÉLÉPHONE</th>
                            <th>N° DOSSIER</th>
                            <th>ACTIONS</th>


                        </tr>
                        <tr>
                            <td>aa</td>
                            <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                         
                            <td><a href="#" class="btn">Fichiers</a>
                           <a href="#" class="btn">Historique</a>
                            <a href="#" class="btn">Archiver</a></td>
                        </tr>
                        <tr>
                              <td>aa</td>
                            <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
   <td><a href="#" class="btn">Fichiers</a>
                           <a href="#" class="btn">Historique</a>
                            <a href="#" class="btn">Archiver</a></td>                        </tr>
                       
                       
                    </table>
                </div>
           </div>
        </div>
  `;
  
  // Ajout du CSS
  const css = `
body {
    min-height: 100vh;
}
a {
    text-decoration: none;
}
li {
    list-style: none;
}
h1,
h2 {
    color: #444;
}
h3 {
    color: #999;
}
.btn {
    background: #f05462;
    color: white;
    padding: 5px 10px;
    text-align: center;
}
.btn:hover {
    color: #f05462;
    background: white;
    padding: 3px 8px;
    border: 2px solid #f05462;
}
.title {
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 15px 10px;
    border-bottom: 2px solid #999;
}
table {
    padding: 10px;
}
th,
td {
    text-align: left;
    padding: 8px;
}
.side-menu {
    position: fixed;
    background: #f05462;
    width: 20vw;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.side-menu .brand-name {
    height: 10vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.side-menu li {
    font-size: 24px;
    padding: 10px 40px;
    color: white;
    display: flex;
    align-items: center;
}
.side-menu li:hover {
    background: white;
    color: #f05462;
}
.container {
    position: absolute;
    right: 0;
    width: 80vw;
    height: 100vh;
    background: #f1f1f1;
}
.container .header {
    position: fixed;
    top: 0;
    right: 0;
    width: 80vw;
    height: 10vh;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    z-index: 1;
}
.container .header .nav {
    width: 90%;
    display: flex;
    align-items: center;
}
.container .header .nav .search {
    flex: 3;
    display: flex;
    justify-content: center;
}
.container .header .nav .search input[type=text] {
    border: none;
    background: #f1f1f1;
    padding: 10px;
    width: 50%;
}
.container .header .nav .search button {
    width: 40px;
    height: 40px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
}
.container .header .nav .search button img {
    width: 30px;
    height: 30px;
}
.container .header .nav .user {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.container .header .nav .user img {
    width: 40px;
    height: 40px;
}
.container .header .nav .user .img-case {
    position: relative;
    width: 50px;
    height: 50px;
}
.container .header .nav .user .img-case img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.container .content {
    position: relative;
    margin-top: 10vh;
    min-height: 90vh;
    background: #f1f1f1;
}
.container .content .cards {
    padding: 20px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.container .content .cards .card {
    width: 250px;
    height: 150px;
    background: white;
    margin: 20px 10px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.container .content .content-2 {
    min-height: 60vh;
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    flex-wrap: wrap;
}
.container .content .content-2 .liste-patients {
    min-height: 50vh;
    flex: 5;
    background: white;
    margin: 0 25px 25px 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    display: flex;
    flex-direction: column;
}
.container .content .content-2 .historique {
    flex: 2;
    background: white;
    min-height: 50vh;
    margin: 0 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    display: flex;
    flex-direction: column;
}
.container .content .content-2 .historique table td:nth-child(1) img {
    height: 40px;
    width: 40px;
}
  `;
  
  const style = document.createElement('style');
  style.innerHTML = css;
  document.head.appendChild(style);
}



// Fonction pour afficher le contenu de la section Paramètres
function afficherParametres() {
  contenu.innerHTML = `
    <h2>A voir</h2>
    

      
   <div class="content">
            <div class="cards"></div>
            <div class="content-2">
                <div class="liste-patients">
                    <div class="title">
                        <h2>Liste des patients</h2>
                      
                    </div>
                    <table>
                        <tr>
                       
                            <th>IPP</th>
                            <th>NOM</th>
                            <th>PRÉNOM</th>
                            <th>DATE DE NAISSANCE</th>
                            <th>VILLE</th>
                            <th>TÉLÉPHONE</th>
                            <th>N° DOSSIER</th>
                            <th>ACTIONS</th>


                        </tr>
                        <tr>
                            <td>aa</td>
                            <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                         
                            <td><a href="#" class="btn">Fichiers</a>
                           <a href="#" class="btn">Historique</a>
                            <a href="#" class="btn">Archiver</a></td>
                        </tr>
                        <tr>
                              <td>aa</td>
                            <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
                             <td>aa</td>
   <td><a href="#" class="btn">Fichiers</a>
                           <a href="#" class="btn">Historique</a>
                            <a href="#" class="btn">Archiver</a></td>                        </tr>
                       
                       
                    </table>
                </div>
           </div>
        </div>
  
  `;
}

    </script>
</body>
</html>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
body {
    min-height: 100vh;
}
a {
    text-decoration: none;
}
li {
    list-style: none;
}
h1,
h2 {
    color: #444;
}
h3 {
    color: #999;
}
.btn {
    background: #f05462;
    color: white;
    padding: 5px 10px;
    text-align: center;
}
.btn:hover {
    color: #f05462;
    background: white;
    padding: 3px 8px;
    border: 2px solid #f05462;
}
.title {
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding: 15px 10px;
    border-bottom: 2px solid #999;
}
table {
    padding: 10px;
}
th,
td {
    text-align: left;
    padding: 8px;
}
.side-menu {
    position: fixed;
    background: #f05462;
    width: 20vw;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.side-menu .brand-name {
    height: 10vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.side-menu li {
    font-size: 24px;
    padding: 10px 40px;
    color: white;
    display: flex;
    align-items: center;
}
.side-menu li:hover {
    background: white;
    color: #f05462;
}
.container {
    position: absolute;
    right: 0;
    width: 80vw;
    height: 100vh;
    background: #f1f1f1;
}
.container .header {
    position: fixed;
    top: 0;
    right: 0;
    width: 80vw;
    height: 10vh;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    z-index: 1;
}
.container .header .nav {
    width: 90%;
    display: flex;
    align-items: center;
}
.container .header .nav .search {
    flex: 3;
    display: flex;
    justify-content: center;
}
.container .header .nav .search input[type=text] {
    border: none;
    background: #f1f1f1;
    padding: 10px;
    width: 50%;
}
.container .header .nav .search button {
    width: 40px;
    height: 40px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
}
.container .header .nav .search button img {
    width: 30px;
    height: 30px;
}
.container .header .nav .user {
    flex: 1;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.container .header .nav .user img {
    width: 40px;
    height: 40px;
}
.container .header .nav .user .img-case {
    position: relative;
    width: 50px;
    height: 50px;
}
.container .header .nav .user .img-case img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.container .content {
    position: relative;
    margin-top: 10vh;
    min-height: 90vh;
    background: #f1f1f1;
}
.container .content .cards {
    padding: 20px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
.container .content .cards .card {
    width: 250px;
    height: 150px;
    background: white;
    margin: 20px 10px;
    display: flex;
    align-items: center;
    justify-content: space-around;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.container .content .content-2 {
    min-height: 60vh;
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    flex-wrap: wrap;
}
.container .content .content-2 .liste-patients {
    min-height: 50vh;
    flex: 5;
    background: white;
    margin: 0 25px 25px 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    display: flex;
    flex-direction: column;
}
.container .content .content-2 .historique {
    flex: 2;
    background: white;
    min-height: 50vh;
    margin: 0 25px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    display: flex;
    flex-direction: column;
}
.container .content .content-2 .historique table td:nth-child(1) img {
    height: 40px;
    width: 40px;
}
@media screen and (max-width: 1050px) {
    .side-menu li {
        font-size: 18px;
    }
}
@media screen and (max-width: 940px) {
    .side-menu li span {
        display: none;
    }
    .side-menu {
        align-items: center;
    }
    .side-menu li img {
        width: 40px;
        height: 40px;
    }
    .side-menu li:hover {
        background: #f05462;
        padding: 8px 38px;
        border: 2px solid white;
    }
}
@media screen and (max-width:536px) {
    .brand-name h1 {
        font-size: 16px;
    }
    .container .content .cards {
        justify-content: center;
    }
    .side-menu li img {
        width: 30px;
        height: 30px;
    }
    .container .content .content-2 .liste-patients table th:nth-child(2),
    .container .content .content-2 .liste-patients table td:nth-child(2) {
        display: none;
    }
}
</style>
