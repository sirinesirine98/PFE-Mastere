<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>E-Consult</title>
</head>

<body>
    <div class="side-menu">

        <div class="brand-name">
            <h1>Menu</h1>
        </div>


        <ul>
            <li><a href="#" id="lien-rendezvous">Liste des Rendez-vous</a></li>
            <li><a href="#" id="lien-patients">Liste des Patients</a></li>
            <li><a href="#" id="lien-fichiers" onclick="afficherFiles()">Fichiers partagés</a></li>

        </ul>

    </div>
    <div class="container">

        <div class="header">

            <div class="nav">

                <div class="search">
                    <input type="text" placeholder="Search..">
                    <button type="submit">

                    </button>
                </div>

                <div class="">
                    <a href="http://localhost:3000/">Join</a>
                </div>

                <x-app-layout>
                </x-app-layout>
            </div>
        </div>
        <div class="content">
            <div class="cards"></div>
            <div class="content-2">




            </div>
        </div>
    </div>
    <script>
        // Récupérer les éléments HTML nécessaires
        const lienRendezVous = document.getElementById('lien-rendezvous');
        const lienPatients = document.getElementById('lien-patients');
        const lienFichiers = document.getElementById('lien-fichiers');
        const contenu = document.querySelector('.content');


        // Ajouter un gestionnaire d'événements de clic sur chaque lien de navigation
        lienRendezVous.addEventListener('click', afficherRendezVous);
        lienPatients.addEventListener('click', afficherPatients);
        lienFichiers.addEventListener('click', afficherFiles);

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
          <table id="liste-rendezvous">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date</th>
                <th>Médecin</th>
                <th>Message</th>
                <th>Status</th>
                <th>États</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  `;

            const listeRendezvous = document.querySelector('#liste-rendezvous tbody');

            fetch('/liste_rdv_medecin')
                .then(response => response.json())
                .then(appointments => {
                    console.log(appointments);
                    const appointmentsApprouves = appointments.filter(appointment => appointment.status === 'Approved');

                    // Afficher les rendez-vous dans la liste
                    appointmentsApprouves.forEach(appointment => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                <td onclick="showPatientDetails(${appointment.id})">${appointment.id}</td>
                <td onclick="showPatientDetails(${appointment.id})">${appointment.name}</td>
                <td onclick="showPatientDetails(${appointment.id})">${appointment.email}</td>
                <td onclick="showPatientDetails(${appointment.id})">${appointment.date}</td>
                <td onclick="showPatientDetails(${appointment.id})">${appointment.doctor}</td>
                <td onclick="showPatientDetails(${appointment.id})">${appointment.message}</td>
                <td onclick="showPatientDetails(${appointment.id})">${appointment.status}</td>
                <td onclick="showPatientDetails(${appointment.id})">${appointment.etat}</td>
            `;
                        listeRendezvous.appendChild(tr);
                    });
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des rendez-vous:', error);
                });




            // Fonction pour afficher une notification
            function afficherNotification(titre, message) {
                // Vérifier si les notifications sont prises en charge par le navigateur
                if (!("Notification" in window)) {
                    console.log("Les notifications ne sont pas prises en charge par votre navigateur.");
                    return;
                }

                // Vérifier le statut de permission pour les notifications
                if (Notification.permission === "granted") {
                    // Créer une nouvelle notification
                    new Notification(titre, {
                        body: message
                    });
                } else if (Notification.permission !== "denied") {
                    // Demander la permission d'afficher des notifications
                    Notification.requestPermission().then(function(permission) {
                        if (permission === "granted") {
                            // Créer une nouvelle notification
                            new Notification(titre, {
                                body: message
                            });
                        }
                    });
                }
            }

            // Fonction pour obtenir les rendez-vous du lendemain et afficher une notification
            function rappelerRendezVous() {
                // Obtenir la date du lendemain
                const dateLendemain = new Date();
                dateLendemain.setDate(dateLendemain.getDate() + 1);
                const jourLendemain = dateLendemain.toISOString().split("T")[0];

                // Effectuer une requête Fetch vers l'API pour récupérer les rendez-vous du lendemain
                fetch(`/rendezvous?date=${jourLendemain}`)
                    .then((response) => response.json())
                    .then((rendezvous) => {
                        if (rendezvous.length > 0) {
                            // Construire le message de la notification avec les rendez-vous
                            let message = "Rendez-vous du lendemain :\n";
                            rendezvous.forEach((rdv) => {
                                message += `- ${rdv.nomPatient} à ${rdv.heure}\n`;
                            });

                            // Afficher la notification
                            afficherNotification("Rappel de rendez-vous", message);
                        }
                    })
                    .catch((error) => {
                        console.error("Erreur lors de la récupération des rendez-vous :", error);
                    });
            }

            // Planifier l'exécution de la fonction de rappel chaque jour à minuit
            function planifierRappelQuotidien() {
                // Obtenir la date et l'heure actuelles
                const maintenant = new Date();
                const millisecondsParJour = 24 * 60 * 60 * 1000;

                // Calculer le délai jusqu'à minuit
                const delai = millisecondsParJour - (maintenant % millisecondsParJour);

                // Planifier l'exécution de la fonction de rappel à minuit
                setTimeout(function() {
                    rappelerRendezVous();

                    // Planifier le prochain rappel quotidien
                    planifierRappelQuotidien();
                }, delai);
            }

            // Vérifier si le navigateur supporte les notifications
            if (!("Notification" in window)) {
                console.log("Les notifications ne sont pas prises en charge par votre navigateur.");
            } else {
                // Vérifier la permission pour les notifications
                if (Notification.permission === "granted") {
                    // Planifier le rappel quotidien
                    planifierRappelQuotidien();
                } else if (Notification.permission !== "denied") {
                    // Demander la permission d'afficher des notifications
                    Notification.requestPermission().then(function(permission) {
                        if (permission === "granted") {
                            // Planifier le rappel quotidien
                            planifierRappelQuotidien();
                        }
                    });
                }
            }

        }

        function afficherFiles() {
            contenu.innerHTML = `
        <div class="content">
            <div class="cards"></div>
            <div class="content-2">
                <div class="liste-patients">
                    <div class="title">
                        <h2>Fichiers partagés</h2>
                    </div>
                    <table id="liste-rooms">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room</th>
                                <th>Date</th>
                                <th>Fichier</th>
                           </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    `;

            fetch('/get_files')
                .then(response => response.json())
                .then(files => {
                    const tbody = document.querySelector('#liste-rooms tbody');
                    tbody.innerHTML = '';
                    console.log(files);
                    files.forEach(file => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${file.id}</td>
                    <td>${file.room}</td>
                    <td>${file.date}</td>
                    <td>${file.fichier}</td>
                `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Une erreur s\'est produite lors de la récupération des fichiers :', error);
                });
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
          <table id="liste-patients">
            <thead>
              <tr>
                <th>IPP</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Email</th>
                <th>Téléphone</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  `;

            const listePatients = document.querySelector('#liste-patients tbody');

            // Effectuer une requête Fetch vers l'API pour récupérer les patients
            fetch('/liste_patients_med')
                .then(response => response.json())
                .then(patients => {
                    // Afficher les patients dans la liste
                    patients.forEach(patient => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
          <td>${patient.IPP}</td>
          <td>${patient.nomdenaissance}</td>
          <td>${patient.prenom}</td>
          <td>${patient.datedenaissance}</td>
          <td>${patient.email}</td>
          <td>${patient.telephone}</td>
        `;
                        listePatients.appendChild(tr);
                    });

                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des patients:', error);
                });
        }

        // Fonction pour afficher les consultations
        function afficherConsultation() {
            contenu.innerHTML = `
     <div class="content">
      <div class="cards"></div>
      <div class="content-2">
        <div class="liste-patients">
          <div class="title">
            <h2>Les des consultations</h2>
          </div>
          <table id="liste-consultations">
            <thead>
              <tr>
                <th>ID Consultation</th>
                <th>Date Consultation</th>
                <th>Heure Consultation</th>
                <th>Médecin</th>
                <th>Patient</th>
              </tr>
            </thead>
            <tbody id="liste-consultations-body"></tbody>
          </table>
        </div>
      </div>
    </div>
  `;

            fetch('/listeConsultations')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.querySelector('#liste-consultations tbody');

                    data.forEach(consultation => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
         <td>${consultation.id_consultation}</td>
         <td>${consultation.date_consultation}</td>
         <td>${consultation.heure_consultation}</td>
         <td>${consultation.médecin}</td>
         <td>${consultation.patient}</td>
`;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Une erreur s\'est produite lors de la récupération des consultations :', error);
                });
        }


        // Fonction pour afficher les consultations
        function afficherComptesRendus() {
            contenu.innerHTML = `

  `;
        }

        function showPatientDetails(id) {
            fetch('/api/patient/' + id)
                .then(response => response.json())
                .then(rendezvous => {
                    console.log(rendezvous);

                    Swal.fire({
                        title: 'Fiche Patient',
                        html: `<h4>Nom: ${rendezvous.nomdenaissance}</h4>
               <h4>Email: ${rendezvous.email}</h4>
               <h4>Date du RDV: ${rendezvous.datedenaissance}</h4>
               <h4>Téléphone: ${rendezvous.telephone}</h4>
               `,
                        input: 'text',
                        inputPlaceholder: 'Ajouter des notes',
                        showCancelButton: true,
                        confirmButtonText: 'Enregistrer',
                        cancelButtonText: 'Annuler',
                    }).then(result => {
                        if (result.isConfirmed) {
                            const notes = result
                                .value; // Récupération de la valeur saisie dans le champ de saisie libre
                            // Effectuer ici les actions nécessaires avec les notes saisies
                        }
                    });
                })
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

    .container .content .content-2 .rappel {
        flex: 2;
        background: white;
        min-height: 50vh;
        margin: 0 25px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        display: flex;
        flex-direction: column;
    }

    .container .content .content-2 .rappel table td:nth-child(1) img {
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
