<?php include('database/connection.php');?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./media/pc_2291988.png" type="image/png"></link>
    <link href="./styles.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        var ip = $('#td_ip').text(); // Supondo que você queira obter o texto do elemento com id 'td_ip'
        $("a.delete").click(function(e){
        if(!confirm('Deletar Registro? ')){
            e.preventDefault();
            return false;
        }
        return true;
        });
    });
    </script>

    <title>Ips Mallet</title>
</head>
<body data-bs-theme="dark">
    
    <div class="card">
        <div class="card-header text-center">
            <div class="logo">
                <img src="./media/pc_2291988.png" class="logo">
            </div>
            <ul class="nav nav-tabs card-header-tabs justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./dashboard.php">Dashboard</a>
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
                    <a class="nav-link active" aria-current="true" href="./ping.php">Ping</a>
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
          
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col" style="text-align: center;">Status</th>
                    <th scope="col">Ip</th>
                    <th scope="col">Local</th>
                    <th scope="col">User</th>
                    <th scope="col">Mac</th>
                </tr>
                </thead>
                <tbody>
                    <form action="editor.php delete.php" method="POST">

                <?php
                $sql = "SELECT * FROM `all_computers` ORDER BY `ip_addr` ASC";
                $result = $conn->query($sql);
                $db = "all_computers";
                
                if ($result->num_rows > 0) {
                    // Exibe os dados do banco de dados
                    while ($row = $result->fetch_assoc()) {

                        $ip_pc = $row["ip_addr"];

                        $status = array(
                            "pc" => $ip_pc,  
                        );
                        
                        
                        echo "<tr class=\"tr_inf\">";
                        //
                        foreach ($status as $pc => $ip) {
                            $connLinux = @fsockopen($ip, 22, $errCode, $errStr, 1); // Porta 22 para Linux (SSH)
                            $connWindows = @fsockopen($ip, 135, $errCode, $errStr, 1); // Porta 135 para Windows
                            $connMac = @fsockopen($ip, 88, $errCode, $errStr, 1); // Porta 88 para MacOS
                        
                            if ($connLinux) {
                                echo "<td class=\"text-center\"><div class=\"spinner-grow text-success\" role=\"status\"></div></td>";
                                fclose($connLinux);
                            } elseif ($connWindows) {
                                echo "<td class=\"text-center\"><div class=\"spinner-grow text-success\" role=\"status\"></div></td>";
                                fclose($connWindows);
                            } elseif ($connMac) {
                                echo "<td class=\"text-center\"><div class=\"spinner-grow text-success\" role=\"status\"></div></td>";
                                fclose($connMac);
                            } else {
                                echo "<td class=\"text-center\"><div class=\"spinner-grow text-danger\" role=\"status\"></div></td>";
                            }
                        }
                        //
                        //   REMOVER COMENTARIOS PARA INSERIR STATUS DE REDE DAS MAQUINAS
                        //
                        echo "<td>" . $row["ip_addr"] . "</td>";
                        echo "<td>" . $row["local"] . "</td>";
                        echo "<td>" . $row["pos"] . " " . $row["user"] . "</td>";
                        echo "<td>" . $row["mac_addr"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>Nenhum registro encontrado.</td></tr>";
                }
                $conn->close();
                ?>
                </form>

                    
                </tbody>
            </table>
          
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
