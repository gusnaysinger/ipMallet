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
        $("a.delete").click(function(e){
            if(!confirm('Deletar Registro? ')){
                e.preventDefault();
                return false;
            }
            return true;
        });

        // Fetch data for charts
        $.ajax({
            url: 'get_data.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var ctxOS = document.getElementById('osChart').getContext('2d');
                var ctxLocal = document.getElementById('localChart').getContext('2d');
                
                // Create OS chart
                new Chart(ctxOS, {
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
                        }
                    }
                });

                // Create Local chart
                new Chart(ctxLocal, {
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
    </script>

    <title>Ips Mallet</title>
</head>
<body data-bs-theme="dark">
    
   

            <!-- Section for displaying the total count and charts -->
            <div class="container mt-5">
                <h2 id="totalCount">Quantidade de Computadores</h2>

                <h3>Quantidade por Sistema Operacional</h3>
                <canvas id="osChart"></canvas>
                <h3>Quantidade por Seção</h3>
                <canvas id="localChart"></canvas>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            Sistema criado por Sd Naysinger - 2024
        </div>
    </div>

    <script src="./script.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0635eb955e.js" crossorigin="anonymous"></script>
</body>
</html>
