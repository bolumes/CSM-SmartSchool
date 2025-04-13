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
            background-color: #e5e5e5;
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
    </div>

  <!--partials sidebar-->
  @include('partials.sidebarlogin')

    <!-- Conteúdo Principal -->
    <div class="main-content" id="main-content">
        <h2 class="text-primary">Bienvenue au Csm-SmartSchool</h2>
        <p class="text-primary">Plataforme de Gestion - Complexe scolaire Multinacional</p>

        
<br>

<h2 class="text-center text-primary mb-4">Nos Services</h2>

<fieldset style="border: #5833ed 2px solid; border-radius: 10px; padding: 20px; background-color: #f8f9fa;"> 
    <br>
    <div class="container my-5">
    
        <div class="row row-cols-1 g-4">
            <!-- Maternelle -->
            <div class="col">
                <div class="card flex-md-row border-primary shadow-sm">
                    <img src="{{ asset('img/jardin0.png') }}" class="img-fluid rounded-start" alt="Maternelle"
                        style="width: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Maternelle 👶</h5>
                        <p class="card-text">
                            Nous offrons un programme éducatif complet pour les enfants d'âge préscolaire.
                        </p>
                        <a class="btn btn-link p-0 text-primary" data-bs-toggle="collapse" href="#maternelle" role="button" aria-expanded="false">
                            Voir plus
                        </a>
                        <div class="collapse mt-2" id="maternelle">
                            <p>
                                Notre programme de maternelle est conçu pour éveiller la curiosité naturelle des enfants.
                            </p>
                            <ul>
                                <li>Activités sensorielles et motrices</li>
                                <li>Introduction aux lettres et aux chiffres</li>
                                <li>Jeux éducatifs adaptés à chaque tranche d’âge</li>
                                <li>Encadrement bienveillant par une équipe spécialisée</li>
                            </ul>
                            <p>
                                L’environnement est sécurisé et stimulant, favorisant l’apprentissage par le jeu et la découverte.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Primaire -->
            <div class="col">
                <div class="card flex-md-row border-success shadow-sm">
                    <img src="{{ asset('img/elementaire1.jpg') }}" class="img-fluid rounded-start" alt="Primaire"
                        style="width: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Primaire 📚</h5>
                        <p class="card-text">
                            Enseignement de qualité avec un accent sur les matières fondamentales.
                        </p>
                        <a class="btn btn-link p-0 text-success" data-bs-toggle="collapse" href="#primaire" role="button" aria-expanded="false">
                            Voir plus
                        </a>
                        <div class="collapse mt-2" id="primaire">
                            <p>
                                Nos classes primaires mettent l’accent sur les compétences fondamentales et la curiosité intellectuelle.
                            </p>
                            <ul>
                                <li>Français, mathématiques, sciences, histoire-géo</li>
                                <li>Ateliers artistiques et sportifs hebdomadaires</li>
                                <li>Suivi personnalisé des progrès de chaque élève</li>
                                <li>Utilisation des nouvelles technologies</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Collège -->
            <div class="col">
                <div class="card flex-md-row border-warning shadow-sm">
                    <img src="{{ asset('img/colege1.jpg') }}" class="img-fluid rounded-start" alt="Collège"
                        style="width: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Collège 🎒</h5>
                        <p class="card-text">
                            Programme rigoureux axé sur les compétences académiques et personnelles.
                        </p>
                        <a class="btn btn-link p-0 text-warning" data-bs-toggle="collapse" href="#college" role="button" aria-expanded="false">
                            Voir plus
                        </a>
                        <div class="collapse mt-2" id="college">
                            <p>
                                Le collège vise à préparer les élèves à une plus grande autonomie scolaire et personnelle.
                            </p>
                            <ul>
                                <li>Approche pluridisciplinaire des enseignements</li>
                                <li>Développement des compétences orales et écrites</li>
                                <li>Clubs scientifiques, artistiques et sportifs</li>
                                <li>Accompagnement à l’orientation scolaire</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Lycée -->
            <div class="col">
                <div class="card flex-md-row border-danger shadow-sm">
                    <img src="{{ asset('img/colege2.jpg') }}" class="img-fluid rounded-start" alt="Lycée"
                        style="width: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Lycée 🎓</h5>
                        <p class="card-text">
                            Préparation aux études supérieures et à la vie professionnelle.
                        </p>
                        <a class="btn btn-link p-0 text-danger" data-bs-toggle="collapse" href="#lycee" role="button" aria-expanded="false">
                            Voir plus
                        </a>
                        <div class="collapse mt-2" id="lycee">
                            <p>
                                Le lycée constitue une étape clé dans le parcours éducatif vers le supérieur ou la vie active.
                            </p>
                            <ul>
                                <li>Préparation au baccalauréat (général, technologique ou pro)</li>
                                <li>Coaching orientation : études supérieures & métiers</li>
                                <li>Projets interdisciplinaires et stages</li>
                                <li>Soutien méthodologique et tutorat</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <br>
</fieldset>

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
