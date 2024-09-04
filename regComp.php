<?php include('database/connection.php');?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./media/pc_2291988.png" type="image/png"></link>
    <link href="./styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ips Mallet - Registro de novo Hardware</title>
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
                    <a class="nav-link" aria-current="true" href="./ping.php">Ping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="true" href="./index.php">Computadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" href="./register.php">Registrar</a>
                </li>
            </ul>
        </div>
        <div class="card-body p-4" style="height: 78vh;">
            <form class="row g-3" method="POST" action="./database/script.php">
                <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" id="btnRegcomp" class="btn btn-primary">Computador</button>
                    <button type="button" id="btnRegmouse" class="btn btn-outline-primary">Mouse</button>
                    <button type="button" id="btnRegteclado" class="btn btn-outline-primary">Teclado</button>
                    <button type="button" id="btnRegmonitor" class="btn btn-outline-primary">Monitor</button>
                    <button type="button" id="btnRegswitch" class="btn btn-outline-primary">Switch</button>
                </div>
                    <script>
                        var btnRegcomp = document.getElementById('btnRegcomp');
                        var btnRegmouse = document.getElementById('btnRegmouse');
                        var btnRegteclado = document.getElementById('btnRegteclado');
                        var btnRegmonitor = document.getElementById('btnRegmonitor');
                        var btnRegswitch = document.getElementById('btnRegswitch');

                        btnRegcomp.addEventListener('click', function(){
                            window.location.href = "./regComp.php"
                        })
                        btnRegmouse.addEventListener('click', function(){
                            window.location.href = "./regMouse.php"
                        })
                        btnRegteclado.addEventListener('click', function(){
                            window.location.href = "./regTeclado.php"
                        })
                        btnRegmonitor.addEventListener('click', function(){
                            window.location.href = "./regMonitor.php"
                        })
                        btnRegswitch.addEventListener('click', function(){
                            window.location.href = "./regSwitch.php"
                        })
                    </script>
                </div>
                <div class="col-md-6">
                    <label for="NameGrad" class="form-label">Local</label>
                    <div class="input-group">
                        <select class="form-select" id="inputLocal" name="loc">
                            <?php
                            $sql_lc = "SELECT * FROM `local`";
                            $result = $conn->query($sql_lc);

                            if ($result->num_rows > 0) {
                                //Exibe Locais
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option>" . $row["secsu"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="inputPg" class="form-label">Nome de Guerra</label>
                    <div class="input-group">
                        <select class="form-select w-25" id="inputPg" name="posgrad">
                            <?php
                            $sql_pg = "SELECT * FROM `posgrad`";
                            $result = $conn->query($sql_pg);

                            if ($result->num_rows > 0) {
                                // Exibe dados pg
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option>" . $row["pg"] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <input type="text" name="user_name" class="form-control w-75" required>
                    </div>
                
                </div>
                <div class="col-md-5">
                    <label for="inputCpu" class="form-label">Processador</label>
                    <input type="text" name="cpu" class="form-control" id="inputCpu" required>
                </div>
                <div class="col-md-3">
                    <label for="inputSystem" class="form-label">Sistema Operacional</label>
                    <select class="form-select" id="inputOs" name="os">
                        <?php
                            $sql_os = "SELECT * FROM `system`";
                            $result = $conn->query($sql_os);

                            if ($result->num_rows > 0) {
                                //Exibe dados os
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option>" . $row["OS"] . "</options>";
                                }
                            }
                        ?>

                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputRam" class="form-label">Memória RAM</label>
                    <select class="form-select" id="inputRam" name="ram">
            <?php
                $sql_ram = "SELECT * FROM `memram` ";
                $result = $conn->query($sql_ram);

                if ($result->num_rows > 0) {
                    // Exibe os dados do banco de dados
                    while ($row = $result->fetch_assoc()) {
                        echo "<option>" . $row["memoria_ram"] . "</option>";
                    }
                }
            ?>

                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputRom" class="form-label">Memória ROM</label>
                    <select class="form-select" id="inputRom" name="rom">
            
            <?php
                $sql_rom = "SELECT * FROM `rom` ";
                $result_rom = $conn->query($sql_rom);
    
                if ($result_rom->num_rows > 0) {
                    // Exibe os dados do banco de dados
                    while ($row = $result_rom->fetch_assoc()) {
                        echo "<option>" . $row["memoria_rom"] . "</option>";
                    }
                }
    
            ?>

                    </select>
                </div>
                <div class="col-md-3">
                    <label for="inputIp" class="form-label">Endereço IP</label>
                    <div class="input-group mb-3">
                        <?php
                            $ip_address = $_SERVER['REMOTE_ADDR'];
                            
                            echo "<input type=\"text\" name=\"ip_addr\" class=\"form-control\" id=\"inputIp\" aria-describedby=\"btnIp\" required>";
                            echo "<button type=\"button\" class=\"btn btn-outline-secondary\" id=\"btnIp\">";
                            echo "<i class=\"fa-solid fa-magnifying-glass\"></i>";
                            echo "</button>";
                        ?>
                        </div>
                        <script>
                            var getIp = document.getElementById('btnIp').addEventListener('click', function() {
                                console.log("ip...");
                                let inputIp = document.getElementById('inputIp');

                                inputIp.value = "<?php echo $ip_address; ?>";
                            });
                        </script>
                    </div>
                <div class="col-md-3">
                    <label for="inputMac" class="form-label">Endereço MAC</label>
                    <input type="text" name="mac_addr" class="form-control macAddr" id="inputMac" aria-describedby="btnMac" required>
                    <!--
                    <input type="text" class="form-control" id="inputMac">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary" type="button" id="btnMac"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    -->
                </div>
                <div class="col-md-3">
                    <label for="inputFicha" class="form-label">Número Ficha</label>
                    <input type="text" name="n_ficha" class="form-control" id="inputFicha">
                </div>
                <div class="col-md-3">
                    <label for="inputLacre" class="form-label">Número Lacre</label>
                    <input type="text" name="n_lacre" class="form-control" id="inputLacre">
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" name="obs" placeholder="Observações do sistema" id="floatingTextarea" style="height: 13vh"></textarea>
                        <label for="floatingTextarea">Observação</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
            <?php
                $conn->close();
            ?>
            
        </div>
        <div class="card-footer text-muted text-center">
            Sistema criado por Sd Naysinger - 2024
        </div>
        
    </div>
    
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/0635eb955e.js" crossorigin="anonymous"></script>

</html>