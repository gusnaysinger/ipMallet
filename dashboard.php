<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./media/pc_2291988.png" type="image/png">
    <link href="./styles.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        // Fetch data for charts
        $.ajax({
            url: 'get_data.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var ctxOS = document.getElementById('osChart').getContext('2d');
                var ctxLocal = document.getElementById('localChart').getContext('2d');
                
                // Create OS chart
                var osChart = new Chart(ctxOS, {
                    type: 'bar',
                    data: {
                        labels: data.os.labels,
                        datasets: [{
                            label: 'Quantidade por Sistema Operacional',
                            data: data.os.data,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        onClick: async (event, elements) => {
                            if (elements.length > 0) {
                                const index = elements[0].index;
                                const label = data.os.labels[index];
                                const computers = await fetchComputers(label);
                                displayComputers(computers);
                            }
                        }
                    }
                });

                // Create Local chart
                var localChart = new Chart(ctxLocal, {
                    type: 'bar',
                    data: {
                        labels: data.local.labels,
                        datasets: [{
                            label: 'Quantidade por Seção',
                            data: data.local.data,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        onClick: async (event, elements) => {
                            if (elements.length > 0) {
                                console.log("JXDXS")
                                const index = elements[0].index;
                                const label = data.local.labels[index];
                                const computers = await fetchComputers(label);
                                displayComputers(computers);
                            }
                        }
                    }
                });
            }
        });

        // Fetch total count
        $.ajax({
            url: 'get_total_count.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#totalCount').text('Total de Computadores: ' + data.total);
            }
        });
    });




    // Função para buscar computadores com base no rótulo
    // Função para buscar computadores com base no rótulo
    async function fetchComputers(label) {
        try {
            const response = await fetch(`./get_computers.php?label=${encodeURIComponent(label)}`);
            if (!response.ok) {
                throw new Error('Erro na resposta do servidor.');
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Erro ao buscar computadores:', error);
            return [];
        }
    }
    
    // Função para exibir os computadores no modal
    function displayComputers(computers) {
        const modalBody = document.getElementById('modal-body');
        modalBody.innerHTML = ''; // Limpa o conteúdo atual do modal
    
        if (computers.length > 0) {
            // Cria uma lista de computadores
            const list = document.createElement('ul');
            list.className = 'list-group';
            list.id = 'computerList'; // Add um ID a lista para facilitar a busca
            
            computers.forEach(computer => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item';
                // Adiciona várias informações ao item da lista
                listItem.innerHTML = `
                    <strong>Nome:</strong> ${computer.pos} ${computer.user}<br>
                    <strong>Endereço IP:</strong> ${computer.ip_addr}<br>
                    <strong>Localização:</strong> ${computer.local}<br>
                    <strong>Endereço MAC:</strong> ${computer.mac_addr}<br>
                    <strong>OS:</strong> ${computer.os}<br>
                    <strong>CPU:</strong> ${computer.cpu}<br>
                    <strong>Memoria RAM:</strong> ${computer.ram}<br>
                    <strong>Memoria ROM:</strong> ${computer.rom}<br>
                `;
                list.appendChild(listItem);
            });
        
            modalBody.appendChild(list);
        } else {
            modalBody.innerHTML = '<p>Nenhum computador encontrado.</p>';
        }
    
        // Mostra o modal usando Bootstrap
        const modal = new bootstrap.Modal(document.getElementById('detailsModal'));
        modal.show();

        // Adiciona o evento de filtro
        document.getElementById('searchBar').addEventListener('keyup', filterComputers);
    }

    // Funcao para filtrar os computadores com base na pesquisa
    function filterComputers() {
        const searchInput = document.getElementById('searchBar').value.toLowerCase();
        const items = document.getElementById('computerList').getElementsByTagName('li');

        for (let i = 0; i < items.length; i++) {
            const item = items[i];
            const text = item.textContent || item.innerHTML;
            if (text.toLowerCase().indexOf(searchInput) > -1) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        }
    }

    </script>

    <title>Ips Mallet</title>
</head>
<body data-bs-theme="dark">
    <style>
        .details{
            position: fixed;
            width: 80vw;
            height: 80vh;
            top: 50%;
            left: 50%;
            transform: translate(-54%, -50%);
            padding: 25px;
            padding-top: 10px;
            display: none;
        }
        .details>h2{
            text-align: center;
        }
    </style>
    <div class="card">
        <div class="card-header text-center">
            <div class="logo" onclick="themeswitch()">
                <img src="./media/pc_2291988.png" class="logo">
            </div>
            <ul class="nav nav-tabs card-header-tabs justify-content-end">
                <!-- Navigation links here -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="./dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./listswitch.php">Switch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./listmonitor.php">Monitores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./listteclado.php">Teclado</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./listmouse.php">Mouse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./ping.php">Ping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./index.php">Computadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./regComp.php">Registrar</a>
                </li>
            </ul>
        </div>
        <div class="card-body ps-0 pe-0" style="min-height: 78vh;">
            <div>
                <!-- Modal para listar computadores -->
                <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailsModalLabel">Computadores</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Adicionando a barra de pesquisa -->
                                <input type="text" id="searchBar" class="form-control mb-3" placeholder="Pesquisar...">

                                <!-- Lista de computadores será inserida aqui via JavaScript -->
                                <div id="modal-body">
                                    <!-- A lista será gerada dinamicamente -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Section for displaying the total count and charts -->
                <div class="container mt-5">
                    <h2 id="totalCount">Quantidade de Computadores</h2>
                    
                    <h3>Quantidade por Sistema Operacional</h3>
                    <canvas id="osChart"></canvas>
                    <h3>Quantidade por Seção</h3>
                    <canvas id="localChart"></canvas>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            Sistema criado por Sd Naysinger - 2024
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0635eb955e.js" crossorigin="anonymous"></script>
</body>
</html>
