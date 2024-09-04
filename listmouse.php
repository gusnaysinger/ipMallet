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
                    <a class="nav-link active" aria-current="true" href="./listmouse.php">Mouse</a>
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
          
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Conector</th>
                    <th scope="col">Funciona</th>
                    <th scope="col">Local</th>
                    <th scope="col">OBS</th>
                    <th scope="col" colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                    <form action="editor.php delete.php" method="POST">

                <?php
                $sql = "SELECT * FROM `all_mouses`";
                $db = "all_mouses";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // Exibe os dados do banco de dados
                    while ($row = $result->fetch_assoc()) {

                        echo "<tr class=\"tr_inf\">";
                        //echo "<td class=\"text-center\"><div class=\"spinner-grow text-danger\" role=\"status\"><span class=\"sr-only\"></span></div></td>";
                        echo "<td>" . $row["marca"] . "</td>";
                        echo "<td>" . $row["modelo"] . "</td>";
                        echo "<td>" . $row["conector"] . " " . $row["user"] . "</td>";
                        echo "<td>" . $row["funciona"] . "</td>";
                        echo "<td>" . $row["local"] . "</td>";
                        echo "<td style=\"max-width:200px\">" . nl2br(htmlspecialchars($row["obs"])) . "</td>";
                        echo "<td><a id=\"btn_delete\" href=\"./database/delete.php?id=" . htmlspecialchars($row["id"]) ."&db=" . $db . "&web=listmouse\" class=\"btn btn-outline-danger delete\" role=\"button\"><i class=\"fa-solid fa-trash icon-editor-btn\"></i></a></td>";
                        echo "<td><a id=\"btn_edit\" href=\"./editorgeral.php?id=" . htmlspecialchars($row["id"]) . "&db=" . $db . "&web=listmouse" . "\" class=\"btn btn-outline-primary\" role=\"button\"><i class='fa-solid fa-pen'></i></a></td>";
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