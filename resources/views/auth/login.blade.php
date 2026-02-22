<!DOCTYPE html>
<html lang="pt-PT">
<head>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSM SmartSchool</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="../../img/books.png">
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
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
            <input type="hidden" placeholder="Pesquisar...">
        </div>
    </div>

  
    <!--partials sidebar-->
   @include('partials.sidebarlogin')
   

    <!-- Conteúdo Principal -->
    <div class="main-content">

             
                   <!-- Container Principal com Imagem e Formulário -->
<div class="container d-flex flex-column justify-content-center align-items-center" style="min-height: 100vh;">

    <!-- Imagem -->
    <!-- <div class="text-center mb-4"> -->
        <!--<img src="../../img/enter.png" alt="Imagem do Formulário" style="height: 80px;"> -->
    <!-- </div> -->

    <!-- Seção do Formulário -->
    <div class="form-container" style="width: 100%; max-width: 500px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fff;">
        
        <!-- Verificar se há uma mensagem de erro -->
        @if(session('error'))
        <div class="alert alert-danger mb-3">
            {{ session('error') }}
        </div>
        @endif

        <fieldset style="border-radius: 10px; border: 2px solid #007bff; padding: 20px;">
            <legend class="text-center" style="color: #007bff; font-size: 20px; font-weight: bold;">CONNEXION</legend>
            <p class="text-center" style="color: #6c757d;">
                <a href="{{ route('home.signup') }}" class="text-decoration-none text-primary">Veuillez vous inscrire ici ? </a>    
            </p>
            
               
            <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                
                        <!-- Mensagem flutuante -->
                        @if (session('success'))
                        <div id="toast-success" class="toast">
                            {{ session('success') }}
                        </div>

                        <style>
                            .toast {
                                position: fixed;
                                top: 20px;
                                right: 20px;
                                background-color: #38a169; /* verde */
                                color: white;
                                padding: 15px 25px;
                                border-radius: 8px;
                                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                                z-index: 9999;
                                animation: slideIn 0.5s, fadeOut 0.5s 3.5s forwards;
                            }

                            @keyframes slideIn {
                                from {
                                    opacity: 0;
                                    transform: translateY(-20px);
                                }
                                to {
                                    opacity: 1;
                                    transform: translateY(0);
                                }
                            }

                            @keyframes fadeOut {
                                to {
                                    opacity: 0;
                                    transform: translateY(-20px);
                                    display: none;
                                }
                            }
                        </style>
                        @endif


                        @if ($errors->any())
                            <p style="color: red;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        
                        @endif


                <div class="row">
                    <!-- Email -->
                    <div class="col-md-12 mb-3">
                        
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="Entrez votre email"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="col-md-12 mb-3">
                        
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="Entrez votre mot de passe"
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="col-md-12 mb-3 form-check">
                        <input 
                            type="checkbox" 
                            class="form-check-input" 
                            id="remember_me" 
                            name="remember"
                        >
                        <label class="form-check-label" for="remember_me">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="col-md-12 d-flex justify-content-between align-items-center mt-3">
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            {{ __('Connecter') }}
                        </button>
                    </div>

                    <!-- Link para recuperação de senha -->
                    @if (Route::has('password.request'))
                    <div class="col-md-12 mt-2 text-center">
                        <a href="{{ route('password.request') }}" class="text-decoration-none text-primary">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    </div>
                    @endif
                </div>
            </form>

        </fieldset>

    </div>
</div>



    </div>
        






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
