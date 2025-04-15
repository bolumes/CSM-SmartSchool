<!DOCTYPE html>
<html lang="pt-PT">
<head>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM SmartSchool</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="img/books.jpg">
    <style>
        /* Estilos Globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden; /* Impede que a página tenha scroll horizontal */
        }

        /* Navbar (Barra Superior) */
        .navbar {
            background-color: #0355ad;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo img {
            width: 145px;
            height: auto;
        }

        .navbar .search {
            flex-grow: 1;
            max-width: 600px;
            margin-left: 20px;
        }

        .navbar input[type="text"] {
            width: 100%;
            padding: 7px;
            border: none;
            border-radius: 2px;
        }

        .navbar .icons {
            display: flex;
            gap: 15px;
        }

        .navbar .icon {
            cursor: pointer;
        }

        /* Menu Lateral (Sidebar) */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #f9f9f9;
            overflow-x: hidden;
            transition: 0.3s;
            padding-top: 20px;
        }

        .sidebar.open {
            width: 180px; /* Largura do menu */
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 8px 15px;
            text-decoration: none;
            color: #333;
            font-size: 18px;
            margin: 0;
        }

        .sidebar a:hover {
            background-color: #afc393;
            color: black;
        }

        .submenu a {
            font-size: 15px;
            padding: 5px 15px;
        }

        .submenu {
            display: none;
            flex-direction: column;
            padding-left: 15px;
        }

        .has-submenu.open + .submenu {
            display: flex;
        }

        .sidebar .has-submenu {
            margin-bottom: 10px;
        }

        .sidebar hr {
            margin: 5px 0;
        }

        /* Ajuste do conteúdo principal */
        .main-content {
            padding: 20px;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .main-content.sidebar-open {
            margin-left: 180px; /* Desloca o conteúdo para a direita quando o menu é aberto */
        }

        .menu-toggle {
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* Carousel */
        .carousel-inner img {
            max-height: 500px;
            object-fit: cover;
        }

       /* cpy */
        .cpy-right {
              padding: 1em;
              background: #6887ff;
          }

          .cpy-right p {
              color: #fff;
          }

          .cpy-right p a {
              color: #fff;
          }

          .language-switcher a {
              margin: 0 5px;
              text-decoration: none;
              font-size: 20px;
          }


          /* Contact Section */
    .contact-section {
        background: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin: 2rem auto;
        padding: 2rem;
    }

    .contact-header {
        position: relative;
        margin-bottom: 2.5rem;
    }

    .contact-header h4 {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        position: relative;
        display: inline-block;
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .contact-info-item {
        transition: all 0.3s ease;
        padding: 1.2rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
    }

    .contact-info-item:hover {
        background: rgba(79, 172, 254, 0.05);
        transform: translateX(10px);
    }

    .contact-info-item i {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(45deg, #4facfe, #00f2fe);
        color: white;
        font-size: 1.4rem;
    }

    .contact-form label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: block;
    }

    .contact-form .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }

    .contact-form .form-control:focus {
        border-color: #4facfe;
        box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.25);
    }

    .submit-btn {
        font-weight: 600;
        letter-spacing: 0.5px;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        transition: all 0.3s ease !important;
        position: relative;
        overflow: hidden;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
    }

    @media (max-width: 768px) {
        .contact-section {
            padding: 1.5rem;
            margin: 1rem;
        }
        
        .contact-info-item {
            margin-bottom: 1rem;
        }
        
        .contact-form .row {
            gap: 1rem;
        }
    }

    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo"><img src="img/logo.png" alt="SmartSchool Logo"></div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
        <div class="icons md:flex hidden">
            <div class="icon" title="Notificações">🔔</div>
            <div class="icon" title="Perfil">👤</div>
            <div class="icon" title="Sair">🔓</div>
        </div>
    </div>

   <!--partials sidebar-->
   @include('partials.sidebarwelcome')

   
    <!-- Conteúdo Principal -->
    <div class="main-content" id="main-content">
        <h2 class="text-primary">Bienvenue au Csm-SmartSchool</h2>
        <p class="text-primary">Plataforme de Gestion - Complexe scolaire Multinacional</p>

        <!-- Exibe o e-mail do usuário logado -->
        <p>
            <strong>{{ Auth::user()->function }}</strong>:
            <strong>{{ Auth::user()->email }}</strong>
        </p>

        <!-- Carrossel -->
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/fundo3.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/fund6.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/fundo4.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
          </div>
          <hr>

      <!-- Maternelle -->
<fieldset>
  <legend align="center"><h3>Maternelle</h3></legend>
  <hr> 
  <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
          <div class="card">
              <img src="img/jardin0.png" class="card-img-top" alt="Maternelle 1">
              <div class="card-body">
                  <h5 class="card-title">Petite Section (PS)</h5>
                  <p class="card-text" id="desc-1" style="display:none;">
                    Introduction au cadre scolaire : apprentissage de la vie en groupe, respect des règles, routines.
                    Développement de la motricité globale et du langage à travers des jeux, chants et activités sensorielles.
                  </p>
                  <button id="btn-1" class="btn btn-primary" onclick="toggleCardDescription(1)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/maternelle3.jpg" class="card-img-top" alt="Maternelle 2">
              <div class="card-body">
                  <h5 class="card-title">Moyenne Section (MS)</h5>
                  <p class="card-text" id="desc-2" style="display:none;">
                    Renforcement du langage oral, enrichissement du vocabulaire, premières structures de phrases.
                    Premiers repères spatiaux et temporels (dedans/dehors, avant/après), motricité fine (découpage, tracés).
                  </p>
                  <button id="btn-2" class="btn btn-primary" onclick="toggleCardDescription(2)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/jardin2.jpg" class="card-img-top" alt="Maternelle 3">
              <div class="card-body">
                  <h5 class="card-title">Grande section (GS)</h5>
                  <p class="card-text" id="desc-3" style="display:none;">
                    Préparation active à la lecture et à l’écriture : reconnaissance des lettres, premiers sons.
                    Introduction aux mathématiques : quantités, suites logiques, comptage, formes géométriques.
                  </p>
                  <button id="btn-3" class="btn btn-primary" onclick="toggleCardDescription(3)">Ver mais</button>
              </div>
          </div>
      </div>
  </div>
</fieldset>

<!-- Élémentaire -->
<fieldset>
  <legend align="center"><h3>Élémentaire</h3></legend>
  <hr>
  <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
          <div class="card">
              <img src="img/elementaire1.jpg" class="card-img-top" alt="Élémentaire 1">
              <div class="card-body">
                  <h5 class="card-title">Cours préparatoire (CP)</h5>
                  <p class="card-text" id="desc-4" style="display:none;">
                    Apprentissage formel de la lecture (phonèmes, syllabes) et de l’écriture cursive.
                    Introduction aux bases du calcul : addition, soustraction, numération jusqu’à 100.
                  </p>
                  <button id="btn-4" class="btn btn-primary" onclick="toggleCardDescription(4)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/elementaire2.jpg" class="card-img-top" alt="Élémentaire 2">
              <div class="card-body">
                  <h5 class="card-title">Cours élémentaire 1, 2 (CE1) & CE2</h5>
                  <p class="card-text" id="desc-5" style="display:none;">
                    Maîtrise de la lecture fluide et compréhension de textes courts.
                    Développement des compétences en calcul mental, problèmes simples, mesures.
                    <br>
                    <br>
                    Consolidation des acquis en français : grammaire, conjugaison, orthographe.
                    Découverte des sciences et de l’espace-temps (journée, saisons, carte, frise chronologique).
                  </p>
                  <button id="btn-5" class="btn btn-primary" onclick="toggleCardDescription(5)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/elementa.jpg" class="card-img-top" alt="Élémentaire 3">
              <div class="card-body">
                  <h5 class="card-title">Cours moyen 1, 2 (CM1) & (CM2)</h5>
                  <p class="card-text" id="desc-6" style="display:none;">
                    Début des rédactions, de la structuration des idées, expression écrite plus autonome.
                    Initiation à l’histoire (époque antique) et à la géographie (territoire français).
                    <br>
                    <br>
                    Révisions globales des cycles précédents, préparation à l’entrée au collège.
                    Projet d’autonomie : exposés, travail en groupe, initiation à la pensée critique.
                  </p>
                  <button id="btn-6" class="btn btn-primary" onclick="toggleCardDescription(6)">Ver mais</button>
              </div>
          </div>
      </div>
    </div>
</fieldset>


<!-- Collège -->
<fieldset>
  <legend align="center"><h3>Collège</h3></legend>
  <hr>
  <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
          <div class="card">
              <img src="img/colege1.jpg" class="card-img-top" alt="Collège 1">
              <div class="card-body">
                  <h5 class="card-title">Sixième (6e)</h5>
                  <p class="card-text" id="desc-7" style="display:none;">
                    Adaptation au rythme du collège, changement de professeurs, emploi du temps.
                    <br>
                    Découverte de nouvelles matières : technologie, SVT, langues vivantes plus approfondies.
                  </p>
                  <button id="btn-7" class="btn btn-primary" onclick="toggleCardDescription(7)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/fund6.png" class="card-img-top" alt="Collège 2">
              <div class="card-body">
                  <h5 class="card-title">Cinquième (5e)</h5>
                  <p class="card-text" id="desc-8" style="display:none;">
                    Approfondissement du raisonnement logique et des connaissances en mathématiques et sciences.
                    <br>
                    Sensibilisation aux enjeux historiques, géographiques et environnementaux actuels.
                  </p>
                  <button id="btn-8" class="btn btn-primary" onclick="toggleCardDescription(8)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/colege.jpg" class="card-img-top" alt="Collège 3">
              <div class="card-body">
                  <h5 class="card-title">Quatrième (4e) & Troisième (3e)</h5>
                  <p class="card-text" id="desc-9" style="display:none;">
                    Développement de l'esprit critique : rédaction argumentée, débats, analyse de documents.
                    Apprentissage plus poussé de la physique-chimie et consolidation des bases scientifiques.
                    <br>
                    <br>
                    Révision de tout le cycle collège, préparation aux examens et au choix d’orientation.
                    Passage du Brevet des collèges, stage en entreprise et premiers projets d’avenir.
                  </p>
                  <button id="btn-9" class="btn btn-primary" onclick="toggleCardDescription(9)">Ver mais</button>
              </div>
          </div>
      </div>
  </div>
</fieldset>

<!-- Lycée -->
<fieldset>
  <legend align="center"><h3>Lycée</h3></legend>
  <hr>
  <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
          <div class="card">
              <img src="img/colege2.jpg" class="card-img-top" alt="Lycée 1">
              <div class="card-body">
                  <h5 class="card-title">Seconde (2de)</h5>
                  <p class="card-text" id="desc-10" style="display:none;">
                    Classe de transition : consolidation des fondamentaux du collège et exploration des spécialités.
                    <br>
                    Développement de la méthode de travail : prise de notes, gestion du temps, autonomie.
                  </p>
                  <button id="btn-10" class="btn btn-primary" onclick="toggleCardDescription(10)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/lyccee1.jpg" class="card-img-top" alt="Lycée 2">
              <div class="card-body">
                  <h5 class="card-title">Première (1re)</h5>
                  <p class="card-text" id="desc-11" style="display:none;">
                    Choix de 2 à 3 spécialités (ex. : mathématiques, littérature, sciences éco), approfondies selon le profil.
                    <br>
                    Épreuves anticipées du Bac (français oral et écrit), entraînement à l’analyse et à l’expression écrite.
                  </p>
                  <button id="btn-11" class="btn btn-primary" onclick="toggleCardDescription(11)">Ver mais</button>
              </div>
          </div>
      </div>
      <div class="col">
          <div class="card">
              <img src="img/ter.jpg" class="card-img-top" alt="Lycée 3">
              <div class="card-body">
                  <h5 class="card-title">Terminale (Tle)</h5>
                  <p class="card-text" id="desc-12" style="display:none;">
                    Finalisation des apprentissages, orientation post-bac (Parcoursup, concours, études supérieures).
                    <br>
                    Passage des épreuves finales du Baccalauréat, projet personnel et professionnel en réflexion active.
                  </p>
                  <button id="btn-12" class="btn btn-primary" onclick="toggleCardDescription(12)">Ver mais</button>
              </div>
          </div>
      </div>
  </div>
</fieldset>

<br>

 

   <script>
        function toggleMenu() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const mainContent = document.getElementById("main-content");

            sidebar.classList.toggle("open");
            overlay.classList.toggle("active");
            mainContent.classList.toggle("sidebar-open"); /* Move the main content */
        }

        function toggleSubmenu(element) {
            element.classList.toggle("open");
        }

        // Função para alternar a descrição dos cards
        function toggleCardDescription(cardId) {
            var cardDescription = document.getElementById('desc-' + cardId);
            var button = document.getElementById('btn-' + cardId);
            
            if (cardDescription.style.display === 'none') {
                cardDescription.style.display = 'block';
                button.innerText = 'Ver menos';
            } else {
                cardDescription.style.display = 'none';
                button.innerText = 'Ver mais';
            }
        }
    </script>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <br> <hr> <br>

    <!-- copyright -->
    <div class="cpy-right text-center">
      <p>© 2025 complexe scolaire multinacional. All rights reserved</p>
  </div>
  <!-- //copyright -->

</body>
</html>
