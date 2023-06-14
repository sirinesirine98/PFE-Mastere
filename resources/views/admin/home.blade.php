
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <title>E-Consult</title>
</head>
<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Menu</h1>
        </div>
        <ul>
            <li><a href="#" id="ajouter-medecin" class="btn-ajouter">Ajouter Médecin</a></li>
            <li><a href="#" id="lien-liste-medecin">Liste des médecins</a></li>
            <li><a href="#" id="lien-liste-rdv">Liste des rendez-vous</a></li>
            <li><a href="#" id="lien-liste-patient">Liste des patients</a></li>
            


        </ul>
    </div>

    <div class="container">
        <div class="header">
          
            <div class="nav">
                <div class="search">
                </div>
                <x-app-layout>
                </x-app-layout>
            </div>
        </div>

        <div class="content">
            <div class="cards">
                <h2 class="first-liste"></h2>
            </div>
          <div class="content-2">


     <div class="formulaire-ajout" align="center" style="padding-top:100px; display: none;">

        <!-- Votre formulaire d'ajout de médecin -->
        <form action="{{ url('upload_doctor') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="padding:15px;">
                <label>Nom du docteur</label>
                <input type="text" required="" name="name" style="color:black;" placeholder="Nom du docteur">
            </div>
            <div style="padding:15px;">
                <label>Téléphone</label>
                <input type="number" required="" name="phone" style="color:black;" placeholder="xxxx xxxx">
            </div>
            <div style="padding:15px;">
                <label>Email</label>
                <input type="text" required="" name="email" style="color:black;" placeholder="email">
            </div>
            <div style="padding:15px;">
                <label>Adresse</label>
                <input type="text" required="" name="address" style="color:black;" placeholder="Adresse">
            </div>
            <div style="padding:15px;">
                <label>Spécialité</label>
                <select style="color:black" name="speciality" required="" id="speciality">
                    <option>--Sélectionner--</option>
                    <option value="Dermatologie">Dermatologie</option>
                    <option value="Psychiatrie">Psychiatrie</option>
                    <option value="Radiologie">Radiologie</option>
                    <option value="Gynécologie">Gynécologie</option>
                    <option value="Biologie">Biologie Médicale</option>
                    <option value="Cardiovasculaire">Médecine cardiovasculaire</option>
                    <option value="Médecine d’urgence">Médecine d’urgence</option>
                </select>
            </div>
            <div style="padding: 20px">
                <label>Image</label>
                <input type="file" required="" name="image" style="color:black;">
            </div>
            
            <button type="submit" style="color:white;background-color:#3A9EEA;border:none;border-radius: 20px;width: 80px;height: 40px;" id="envoyer">Envoyer</button>
        </form>
    </div>
     <div class="medecins-liste" id="tbody-medecins" style="display: none; ; margin: 20px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom du médecin</th>
                                    <th>Téléphone du médecin</th>
                                    <th>Email du médecin</th>
                                    <th>Spécialité du médecin</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

   <div class="rdvs-liste" style="display: none; margin: 20px;">
    <table>
        <thead>
            <tr>
                <th>Nom du patient</th>
                <th>Téléphone du patient</th>
                <th>Médecin sélectionné</th>
                <th>Date de RDV</th>
                <th>Symptômes / Description</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody id="tbody-rdvs"></tbody>

    </table>
</div>

<!-- Formulaire de confirmation -->
<div id="formulaire-confirmation" style="display: none;">
  <h3>Confirmation de rendez-vous</h3>
  <!-- Ajoutez les champs nécessaires pour la confirmation du rendez-vous -->

  <!-- Bouton de soumission -->
  <button type="submit">Confirmer</button>
</div>

<div class="patients-liste" style="display: none; margin: 20px;">
    <table>
        
        <tbody id="tbody-patients"></tbody>
    </table>
</div>
         
                                        
</div>

<script>
    // Récupérer les éléments HTML nécessaires
    const medecinsListe = document.querySelector('.medecins-liste');
    const firstListe = document.querySelector('.first-liste');
    const tbodyMedecins = document.getElementById('tbody-medecins');
    const afficherMedecinsBtn = document.getElementById('afficher-medecins');
    const formulaireAjout = document.querySelector('.formulaire-ajout');
    const ajouterMedecinBtn = document.getElementById('ajouter-medecin');
    //liens des rdvs
    const lienListeRdv = document.getElementById('lien-liste-rdv');
    const rdvsListe = document.querySelector('.rdvs-liste');
    const tbodyRdvs = document.getElementById('tbody-rdvs');
  const lienListePatients = document.getElementById('lien-liste-patient');
const patientsListe = document.querySelector('.patients-liste');
const tbodyPatients = document.getElementById('tbody-patients');

lienListePatients.addEventListener('click', ajouterPatient); // Utilisez "ajouterPatient" ici


//event mta3 click menu lister les RDVs
lienListeRdv.addEventListener('click', afficherRdv);

    // Fonction pour afficher le contenu de la section Liste des médecins
  function afficherMedecin() {
    medecinsListe.style.display = 'block';
    formulaireAjout.style.display = 'none'; // Masquer le formulaire d'ajout
    firstListe.style.display = 'none'; // Masquer le mot teeeeeeeeest
     rdvsListe.style.display = 'none'; //Masquer la liste des rdv
     patientsListe.style.display = 'none'; //Masquer la liste des patients
     


    fetch('/liste_docteur')
        .then(response => response.json())
        .then(data => {
            // Réinitialiser le contenu du tableau
            tbodyMedecins.innerHTML = '';

            // Ajouter les en-têtes du tableau
            const headerRow = document.createElement('tr');
            headerRow.innerHTML = `
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Spécialité</th>
                <th>Actions</th>
            `;
            tbodyMedecins.appendChild(headerRow);

            // Parcourir les médecins et les ajouter au tableau
            data.forEach(medecin => {
                const rowMedecin = document.createElement('tr');
                rowMedecin.innerHTML = `
                    <td>${medecin.name}</td>
                    <td>${medecin.phone}</td>
                    <td>${medecin.email}</td>
                    <td>${medecin.speciality}</td>
                    <td>
            <button class="btn btn-success" onclick="modifierMedecin(${medecin.id})">Modifier</button>
            <button class="btn btn-danger" onclick="supprimerMedecin(${medecin.id})">Supprimer</button>
          </td>
                `;
                tbodyMedecins.appendChild(rowMedecin);
            });
        })
        .catch(error => {
            console.error('Une erreur s\'est produite lors de la récupération des médecins :', error);
        });
}


function liste_patients() {
     medecinsListe.style.display = 'none';
    formulaireAjout.style.display = 'none'; 
    firstListe.style.display = 'none';    
     rdvsListe.style.display = 'none';
     patientsListe.style.display = 'block';
     

    fetch('/liste_patients')
        .then(response => response.json())
        .then(data => {
            tbodyPatients.innerHTML = '';

            const headerRow = document.createElement('tr');
            headerRow.innerHTML = `
                <th>Nom du patient</th>
                <th>Téléphone du patient</th>
                <th>Email du patient</th>
                <th>Adresse du patient</th>
            `;
            tbodyPatients.appendChild(headerRow);

            data.forEach(patient => {
                const rowPatient = document.createElement('tr');
                rowPatient.innerHTML = `
                    <td>${patient.nomdenaissance}</td>
                    <td>${patient.telephone}</td>
                    <td>${patient.email}</td>
                    <td>${patient.ville}</td>
                `;
                tbodyPatients.appendChild(rowPatient);
            });
        })
        .catch(error => {
            console.error('Une erreur s\'est produite lors de la récupération des patients :', error);
        });
}


function modifierMedecin(id) {
    fetch(`/medecin/${id}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération du médecin');
            }
            return response.json();
        })
        .then(medecin => {
            // Utilisez les données du médecin pour afficher ou mettre à jour le formulaire
            console.log(medecin);
        })
        .catch(error => {
            console.error('Erreur lors de la récupération du médecin:', error);
        });
}




    // Ajouter un gestionnaire d'événements de clic sur le lien "Lister les médecins"
    const lienListeMedecin = document.getElementById('lien-liste-medecin');
    lienListeMedecin.addEventListener('click', afficherMedecin);

    // Ajouter un gestionnaire d'événements de clic sur le bouton "Ajouter médecin"
    ajouterMedecinBtn.addEventListener('click', function() {
        medecinsListe.style.display = 'none';
    formulaireAjout.style.display = 'block'; 
    firstListe.style.display = 'none';    
     rdvsListe.style.display = 'none';
     patientsListe.style.display = 'none';
     

    });

    // Masquer le formulaire d'ajout de médecin
    function masquerFormulaireAjout() {
    medecinsListe.style.display = 'none';
    formulaireAjout.style.display = 'none'; 
    firstListe.style.display = 'none';    
     rdvsListe.style.display = 'none';
     patientsListe.style.display = 'none';
    }

    // Ajouter un gestionnaire d'événements de clic sur le lien "Lister les médecins" dans le formulaire d'ajout
    const lienListeMedecinFormulaire = document.getElementById('lien-liste-medecin-formulaire');
    lienListeMedecinFormulaire.addEventListener('click', function() {
        masquerFormulaireAjout();
        afficherMedecin();
    });



// Fonction pour afficher le contenu de la section Liste des RDV
function afficherRdv() {
  rdvsListe.style.display = 'block';
  medecinsListe.style.display = 'none'; // Masquer la liste des médecins
  formulaireAjout.style.display = 'none'; // Masquer le formulaire d'ajout de médecin
  firstListe.style.display = 'none'; // Masquer le mot teeeeeeeeest
  patientsListe.style.display = 'none'; //Masquer la liste des patients


  fetch('/liste_rdv')
    .then(response => response.json())
    .then(data => {
      // Réinitialiser le contenu du tableau
      tbodyRdvs.innerHTML = '';

      // Parcourir les rendez-vous et les ajouter au tableau
      data.forEach(rendezvousItem => {
        const rowRdv = document.createElement('tr');
        rowRdv.innerHTML = `
          <td>${rendezvousItem.name}</td>
          <td>${rendezvousItem.phone}</td>
          <td>${rendezvousItem.doctor}</td>
          <td>${rendezvousItem.date}</td>
          <td>${rendezvousItem.message}</td>
          <td>${rendezvousItem.status}</td>
         <td>
            <button class="btn btn-success" onclick="confirmerRdv(${rendezvousItem.id})">Confirmer</button>
            <button class="btn btn-danger" onclick="supprimerRdv(${rendezvousItem.id})">Supprimer</button>
          </td>
        `;
        tbodyRdvs.appendChild(rowRdv);
      });
    })
    .catch(error => {
      console.error('Une erreur s\'est produite lors de la récupération des RDV :', error);
    });
}

function confirmerRdv(idRdv) {
  fetch(`/appointment/approve/${idRdv}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Voulez vous approuvé le Rendez-vous !');
      afficherRdv(); // Actualiser la liste des rendez-vous
    } else {
      alert('Une erreur s\'est produite lors de l\'approbation du rendez-vous.');
    }
  })
  .catch(error => {
    console.error('Une erreur s\'est produite lors de l\'approbation du rendez-vous :', error);
  });
}



function ajouterPatient() {
  fetch('/listePatientsApprouves')
    .then(response => response.json())
    .then(data => {
      // Réinitialiser le contenu de la liste des patients
      listePatients.innerHTML = '';

      // Créer le tableau
      const table = document.createElement('table');

      // Créer l'en-tête du tableau
      const thead = document.createElement('thead');
      const headerRow = document.createElement('tr');
      headerRow.innerHTML = `
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
        <th>Ville</th>
        <th>Email</th>
        <th>Téléphone</th>
      `;
      thead.appendChild(headerRow);
      table.appendChild(thead);

      // Créer le corps du tableau
      const tbody = document.createElement('tbody');

      // Parcourir les patients et les ajouter au tableau
      data.forEach(patient => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${patient.nomdenaissance}</td>
          <td>${patient.prenom}</td>
          <td>${patient.datedenaissance}</td>
          <td>${patient.ville}</td>
          <td>${patient.email}</td>
          <td>${patient.telephone}</td>
        `;
        tbody.appendChild(row);
      });

      table.appendChild(tbody);

      // Ajouter le tableau à la liste des patients
      listePatients.appendChild(table);
    })
    .catch(error => {
      console.error('Une erreur s\'est produite lors de la récupération des patients :', error);
    });
}


    </script>

   

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
    padding: 30px;
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
    display: none;
    flex-direction: column;
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
}
</style>
</body>
</html>