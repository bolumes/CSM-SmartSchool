<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
    <link rel="icon" href="../../img/books.png">
    <style>
        /* Estilos adicionais para o botão de pesquisa */
        tr {
            height: 40px;
        }

        tr:hover {
            height: 40px;
            background-color: #afc393;
            cursor: pointer;
            color: blue;
        }

        th {
            background-color: #1c359d;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <div class="logo" ><img src="../../img/logo.png" ></div>
        <div class="search">
            <input type="text" placeholder="Pesquisar...">
        </div>
    </div>

   <!--partials sidebar-->
   @include('partials.sidebarwelcome')

    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">DETAILS SALLE</h3></legend>
        
        <!-- Container Principal com Imagem e Formulário -->
        <div class="container">

             <!-- Seção da Imagem -->
             <div class="form-image">
                <img src="../../img/det.png" alt="Imagem do Formulário" style="height: 80px; margin-left: 40px;">
            </div>

            <!-- Seção do Formulário -->
            <div class="form-container">

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

               
                <table border="1" style="width: 100%; margin: 0 auto; border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <td style="text-align: center; font-weight: bold; width: 40%;  background-color: #1c359d; color: white;">ATRIBUTO</td>
                            <td style="text-align: center; font-weight: bold; width: 40%;  background-color: #1c359d; color: white;">VALOR</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold; width: 40%;">ID</td>
                            <td align="center">{{ $sala->id }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Nom</td>
                            <td align="center">{{ $sala->name }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Reserver</td>
                            <td align="center">{{ $sala->reservar }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Categorie</td>
                            <td align="center">{{ $sala->categoria }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Capacite</td>
                            <td align="center">{{ $sala->capacidade }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Édifice</td>
                            <td align="center">{{ $sala->edificio->name ?? 'N/A' }}</td>
                        </tr>
                    
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Característiques</td>
                            <td align="center">{{ $sala->caracteristicas }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Localisation</td>
                            <td align="center">{{ $sala->localizacao }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-weight: bold;">Image</td>
                            <td align="center">{{ $sala->imagem }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>
    </div>

    <!-- Script para Toggle do Menu -->
    <script>
        function toggleMenu() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");

            sidebar.classList.toggle("open");
            overlay.classList.toggle("active");
        }

        function toggleSubmenu(element) {
            element.classList.toggle("open");
            const submenu = element.nextElementSibling;
            submenu.style.display = submenu.style.display === "flex" ? "none" : "flex";
        }
    </script>
</body>
</html>





