<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>E-Consult</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Menu</h1>
        </div>
        <ul>
            <li><a href="#" id="lien-liste-patient" onclick="liste_patients()">Liste des patients</a></li>
            <li><a href="#" id="lien-liste-medecin">Liste des médecins</a></li>
            <li><a href="#" id="lien-liste-rdv">Liste des rendez-vous</a></li>
            <li><a href="#" id="ajouter-medecin" class="btn-ajouter">Ajouter un médecin</a></li>

        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="search">
                </div>
                <div class="notification-icon">
                    <button id="notification-button" class="notification-button">
                        <i class="fas fa-bell"></i>
                        <span class="notification-count"></span>
                    </button>
                </div>

                <div id="notification-modal" class="notification-modal">
                    <div class="notification-content">
                        <!-- Contenu des notifications -->
                    </div>
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
                            <input type="text" required="" name="name" style="color:black;"
                                placeholder="Nom du docteur">
                        </div>
                        <div style="padding:15px;">
                            <label>Téléphone</label>
                            <input type="number" required="" name="phone" style="color:black;"
                                placeholder="xxxx xxxx">
                        </div>
                        <div style="padding:15px;">
                            <label>Email</label>
                            <input type="text" required="" name="email" style="color:black;"
                                placeholder="email">
                        </div>
                        <div style="padding:15px;">
                            <label>Adresse</label>
                            <input type="text" required="" name="address" style="color:black;"
                                placeholder="Adresse">
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
                        <button type="submit"
                            style="color:white;background-color:#3A9EEA;border:none;border-radius: 20px;width: 80px;height: 40px;"
                            id="envoyer">Envoyer</button>
                    </form>
                </div>
                <div class="medecins-liste" id="tbody-medecins" style="display: none; ; margin: 20px;">
                    <table>
                        <thead>
                            <tr>
                                <th>ID Médecin</th>
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
                                <th>ID RDV</th>
                                <th>Nom du patient</th>
                                <th>Téléphone du patient</th>
                                <th>Email du patient</th>
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
                <div class="patients-liste" id="tbody-patients" style="display: none; ; margin: 20px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom du patient</th>
                                <th>Téléphone du patient</th>
                                <th>Email du patient</th>
                                <th>Address du patient</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- Formulaire de confirmation -->
                <div id="formulaire-confirmation" style="display: none;">
                    <h3>Confirmation de rendez-vous</h3>
                    <!-- Ajoutez les champs nécessaires pour la confirmation du rendez-vous -->
                    <!-- Bouton de soumission -->
                    <button type="submit">Confirmer</button>
                </div>
            </div>
            <script>
                const notificationButton = document.getElementById('notification-button');
                const notificationModal = document.getElementById('notification-modal');
                const notificationList = document.getElementById('notification-list');
                const notificationCount = document.getElementById('notification-count');



                // Fonction pour afficher les notifications
                function showNotifications() {
                    // Réinitialiser la liste des notifications
                    notificationList.innerHTML = '';

                    // Mettre à jour le compteur de notifications
                    notificationCount.textContent = notifications.length;

                    // Parcourir les notifications et les ajouter à la liste
                    notifications.forEach(notification => {
                        const listItem = document.createElement('li');
                        listItem.textContent = notification.message;
                        notificationList.appendChild(listItem);
                    });

                    // Afficher la fenêtre modale
                    notificationModal.style.display = 'block';
                }

                // Gérer le clic sur le bouton de notification
                notificationButton.addEventListener('click', showNotifications);


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

                lienListeRdv.addEventListener('click', afficherRdv);

                let meds = [];

                // Fonction pour afficher le contenu de la section Liste des médecins
                function afficherMedecin() {
                    medecinsListe.style.display = 'block';
                    formulaireAjout.style.display = 'none'; // Masquer le formulaire d'ajout
                    firstListe.style.display = 'none'; // Masquer le mot teeeeeeeeest
                    rdvsListe.style.display = 'none'; //Masquer la liste des rdv
                    patientsListe.style.display = 'none'; //Masquer la liste des patient
                    fetch('/liste_docteur')
                        .then(response => response.json())
                        .then(data => {
                            meds = data
                            // Réinitialiser le contenu du tableau
                            tbodyMedecins.innerHTML = '';

                            // Ajouter les en-têtes du tableau
                            const headerRow = document.createElement('tr');
                            headerRow.innerHTML = `
                     <th>ID Médecin</th>
                    <th>Image</th>
                     <th>Nom Médecin</th>
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
                         <td>${medecin.id}</td>
                         <td><img src="/doctorimage/${medecin.image}" alt="Image du médecin" style="width: 100px; height: 100px;"></td>
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


                const clearModifForm = () => {
                    let modifForms = document.querySelectorAll(".modif-form-container")
                    modifForms.forEach(elem => elem.remove())
                    //modifForm.remove();
                }

                function modifierMedecin(id) {
                    clearModifForm()

                    let selectedMed = meds.filter(med => med.id === id)[0]

                    const medecinsListe = document.querySelector('.medecins-liste');
                    let formModifMed = `
                    <br><br>
                  <h1>Modifier Medecin:</h1>
            <form class="modif-form" method="POST" action="modifMed">
                    <label for="text">Nom:</label><br>
                    <input type="text" id="modif-name" name="name" value="${selectedMed.name}"><br>

                    <label for="tel">Téléphone:</label><br>
                    <input type="tel" id="modif-phone" name="phone" value="${selectedMed.phone}"><br>

                    <label for="email">Email:</label><br>
                    <input type="email" id="modif-email" name="email" value="${selectedMed.email}"><br>

                    <!--<label for="text">Addresse:</label><br>
                     <input type="ville" id="ville" name="ville" value="${selectedMed.ville}"><br>-->

                    <label for="text">Spécialité:</label><br>
                    <input type="text" id="modif-speciality" name="speciality" value="${selectedMed.speciality}"><br>

                     <label for="text">Image:</label><br>
                    <input type="file" id="modif-image" name="image" value="${selectedMed.image}"><br>


                    <br>

            </form>

              <button class="btn btn-success" onclick="submitModif(${id})">Enregistrer</button>
          `

                    let formModifMedElem = document.createElement('div')
                    formModifMedElem.className = 'modif-form-container'
                    formModifMedElem.innerHTML = formModifMed
                    medecinsListe.appendChild(formModifMedElem);

                }



                function submitModif(id) {
                    let data = {
                        name: document.querySelector('#modif-name').value,
                        email: document.querySelector('#modif-email').value,
                        speciality: document.querySelector('#modif-speciality').value,
                        phone: document.querySelector('#modif-phone').value,
                    }
                    let myHeaders = new Headers();
                    myHeaders.append("Content-Type", "application/json");

                    let raw = JSON.stringify(data);

                    let requestOptions = {
                        method: 'PUT',
                        headers: myHeaders,
                        body: raw,
                        redirect: 'follow'
                    };

                    fetch("http://localhost:8001/api/modifier_docteur/" + id, requestOptions)
                        .then(response => response.json())
                        .then(result => {
                            alert("Medecin modifié avec succès");
                            // reload page
                            location.reload();
                        })
                        .catch(error => console.log('error', error));
                }

                function supprimerMedecin(idMedecin) {
                    let confirmSuppression = confirm('Voulez-vous supprimer ce médecin ?');

                    if (confirmSuppression) {
                        fetch(`/medecin/supprimer/${idMedecin}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error('Une erreur s\'est produite lors de la suppression du médecin.');
                                }
                            })
                            .then(data => {
                                if (data.success) {
                                    afficherMedecin(); // Actualiser la liste des médecins
                                } else {
                                    throw new Error('Une erreur s\'est produite lors de la suppression du médecin.');
                                }
                            })
                            .catch(error => {
                                console.error('Une erreur s\'est produite lors de la suppression du médecin :', error);
                            });
                    }
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

                     <th>ID du patient</th>
                     <th>Nom du patient</th>
                     <th>Téléphone du patient</th>
                     <th>Email du patient</th>
                     <th>Adresse du patient</th>
                 `;
                            tbodyPatients.appendChild(headerRow);

                            data.forEach(patient => {
                                const rowPatient = document.createElement('tr');
                                rowPatient.innerHTML = `
                         <td>${patient.IPP}</td>
                         <td>${patient.nomdenaissance}</td>
                         <td>${patient.telephone}</td>
                         <td>${patient.email}</td>
                         <td>${patient.ville ? patient.ville : '---'}</td>
                     `;
                                tbodyPatients.appendChild(rowPatient);
                            });
                        })
                        .catch(error => {
                            console.error('Une erreur s\'est produite lors de la récupération des patients :', error);
                        });
                }

                // Appel de la fonction pour afficher la liste des patients au chargement de la page

                //liste_patients();




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
               <td>${rendezvousItem.id}</td>
               <td>${rendezvousItem.name}</td>
               <td>${rendezvousItem.phone}</td>
               <td>${rendezvousItem.email}</td>
               <td>${rendezvousItem.doctor}</td>
               <td>${rendezvousItem.date}</td>
               <td>${rendezvousItem.message}</td>
               <td>${rendezvousItem.status}</td>
              <td>
                 <button class="btn btn-success" onclick="confirmerRdv(${rendezvousItem.id}, '${rendezvousItem.doctor}')">Confirmer</button>
                 <button class="btn btn-danger" onclick="rejeterRdv(${rendezvousItem.id})">Rejeter</button>
               </td>
             `;
                                tbodyRdvs.appendChild(rowRdv);
                            });
                        })
                        .catch(error => {
                            console.error('Une erreur s\'est produite lors de la récupération des RDV :', error);
                        });
                }

                function confirmerRdv(idRdv, doctor) {

                    let approveRdv = confirm('Voulez vous approuvé le Rendez-vous ?')

                    if (approveRdv == true) {
                        fetch(`/appointment/approve/${idRdv}/${doctor}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    afficherRdv(); // Actualiser la liste des rendez-vous
                                } else {
                                    alert('Une erreur s\'est produite lors de l\'approbation du rendez-vous.');
                                }
                            })
                            .catch(error => {
                                console.error('Une erreur s\'est produite lors de l\'approbation du rendez-vous :', error);
                            });
                    }



                }

                function rejeterRdv(idRdv) {
                    let rejectRdv = confirm('Voulez-vous rejeter le rendez-vous ?');

                    if (rejectRdv) {
                        fetch(`/appointment/reject/${idRdv}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    afficherRdv(); // Actualiser la liste des rendez-vous
                                } else {
                                    alert('Une erreur s\'est produite lors du rejet du rendez-vous.');
                                }
                            })
                            .catch(error => {
                                console.error('Une erreur s\'est produite lors du rejet du rendez-vous :', error);
                            });
                    }
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
                    width: 30%;
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

                .container .content .content-2 .recent-payments {
                    min-height: 50vh;
                    flex: 5;
                    background: white;
                    margin: 0 25px 25px 25px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    display: flex;
                    flex-direction: column;
                }

                .container .content .content-2 .new-students {
                    flex: 2;
                    background: white;
                    min-height: 50vh;
                    margin: 0 25px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    display: flex;
                    flex-direction: column;
                }

                .container .content .content-2 .new-students table td:nth-child(1) img {
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

                    .container .content .content-2 .recent-payments table th:nth-child(2),
                    .container .content .content-2 .recent-payments table td:nth-child(2) {
                        display: none;
                    }



                    .modif-form>input {
                        width: 100%;
                    }

                    .notification-icon {
                        position: relative;
                        display: inline-block;
                    }

                    .notification-button {
                        border: none;
                        background: none;
                        cursor: pointer;
                    }

                    .notification-button i {
                        font-size: 24px;
                    }

                    .notification-count {
                        position: absolute;
                        top: -5px;
                        right: -5px;
                        background-color: red;
                        color: white;
                        border-radius: 50%;
                        padding: 2px 5px;
                        font-size: 12px;
                    }

                    .notification-modal {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.5);
                        display: none;
                        z-index: 9999;
                    }

                    .notification-content {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background-color: white;
                        padding: 20px;
                        border-radius: 5px;
                    }
            </style>
</body>

</html>
