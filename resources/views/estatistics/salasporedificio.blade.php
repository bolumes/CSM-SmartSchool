<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pla-moss</title>
    <link rel="stylesheet" href="../css/style1.css"> <!-- Link para o arquivo CSS externo -->
    <link rel="icon" href="../../img/books.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        /* Estilo para o SweetAlert personalizado */
        .small-popup {
            font-size: 16px; /* Ajuste o tamanho da fonte */
            padding: 20px; /* Adiciona mais espaço dentro da caixa */
        }

        .chart-container {
        width: 70%;
        margin: 30px auto;
      }

      canvas {
        max-width: 100%;
        height: auto;
      }

      /* Responsividade */
      @media screen and (max-width: 768px) {
        .form-image {
          display: none;
        }
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
   @include('partials.sidebarsettings')
    <!-- Conteúdo Principal -->
    <div class="main-content">
        <fieldset style="border-radius: 8px; border: 2px solid blue;">
            <legend style="text-align: center;"><h3 style="text-align: center; color: blue;">SALLES POUR EDIFICE</h3></legend>
        
            <!-- Container Principal com Imagem e Formulário -->
            <div class="container">

                <!-- Tabela de Estatísticas -->
<div style="overflow-x: auto; margin-bottom: 2rem;">
    <table style="width: 100%; border-collapse: collapse; background-color: #fff; border: 1px solid #ccc; border-radius: 6px;">
        <thead>
            <tr>
                <th style="padding: 12px; background-color: #1c359d; color: white;">Edifice</th>
                <th style="padding: 12px; background-color: #1c359d; color: white;">N° Salles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estatistics as $estatistic)
                <tr style="transition: 0.3s;" onmouseover="this.style.backgroundColor='#eef2ff'" onmouseout="this.style.backgroundColor=''">
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $estatistic->edificio_nome }}</td>
                    <td style="padding: 10px; border: 1px solid #ccc;">{{ $estatistic->numero_de_salas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Gráfico -->
<div class="chart-container">
    <canvas id="chartjs_bar"></canvas>
</div>

<!-- Script do Gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('chartjs_bar').getContext('2d');

        const labels = @json($estatistics->pluck('edificio_nome'));
        const data = @json($estatistics->pluck('numero_de_salas'));

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Salles pour Edifice',
                    data: data,
                    backgroundColor: [
                        '#5969aa', '#ff407b', '#25d5f2', '#ffc750',
                        '#2ec551', '#ffc107', '#36a2eb', '#ff6384'
                    ],
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>

  
            </div>
        </fieldset>
    </div>

</body>
</html>

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
