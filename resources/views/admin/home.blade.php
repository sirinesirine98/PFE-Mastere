
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Consult</title>
</head>
<body>
    <div class="side-menu">
        <div class="brand-name">
            <h1>Menu</h1>
        </div>
        <ul>
            <li><a href="#" id="lien-liste-medecin">Lister les médecins</a></li>
            <li><a href="#" id="lien-patients">Ajouter Médecin</a></li>
            <li><a href="#" id="lien-parametres">Lister les RDV</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="header">
          <h1>Ma page</h1>
            <div class="nav">
                <div class="search">
                </div>
                <x-app-layout>
                </x-app-layout>
            </div>
        </div>

        <div class="content">
            <div class="cards">
                <h2>Hello</h2>
            </div>
            <div class="content-2">
                <div class="liste-patients">
                    <div class="title">
                        <h2>Liste des Médecins</h2>
                        <a href="#" class="btn" id="afficher-medecins">Afficher</a>
                    </div>

          
                    <div class="medecins-liste" style="display: none;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Spécialité</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

                <div id="paragraphe" style="display: none;">
                     <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                    <th>Spécialité</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        // Récupérer les éléments HTML nécessaires
        const medecinsListe = document.querySelector('.medecins-liste');
        const tbody = medecinsListe.querySelector('tbody');
        const afficherMedecinsBtn = document.getElementById('afficher-medecins');
        const paragraphe = document.getElementById('paragraphe');

       // Fonction pour afficher le contenu de la section Liste des medecins
function afficherMedecin() {
    document.querySelector('.cards').style.display = 'none'; // Rendre la section "Hello" invisible
    fetch('/liste_docteur')
        .then(response => response.json())
        .then(data => {
            // Réinitialiser le contenu du tableau
            tbody.innerHTML = '';

            // Parcourir les médecins et les ajouter au tableau
            data.forEach(medecin => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${medecin.name}</td>
                    <td>${medecin.phone}</td>
                    <td>${medecin.email}</td>
                    <td>${medecin.speciality}</td>
                `;
                tbody.appendChild(row);
            });

       

            // Rendre le card visible
            medecinsListe.style.display = 'block';
            paragraphe.style.display = 'block';
        })
        .catch(error => {
            console.error('Une erreur s\'est produite lors de la récupération des médecins :', error);
        });
}


        // Ajouter un gestionnaire d'événements de clic sur le lien
        const lienListeMedecin = document.getElementById('lien-liste-medecin');
        lienListeMedecin.addEventListener('click', afficherMedecin);
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
}
</style>
</body>
</html>