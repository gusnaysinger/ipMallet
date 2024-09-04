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
            <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <button type="button" id="btnRegcomp" class="btn btn-outline-primary">Computador</button>
                        <button type="button" id="btnRegmouse" class="btn btn-outline-primary">Mouse</button>
                        <button type="button" id="btnRegteclado" class="btn btn-outline-primary">Teclado</button>
                        <button type="button" id="btnRegmonitor" class="btn btn-outline-primary">Monitor</button>
                        <button type="button" id="btnRegswitch" class="btn btn-primary">Switch</button>
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
            
                <form class="row g-3 mt-1" method="POST" action="./database/scriptswitch.php">
                    <div class="col-md-4">
                        <label for="inputMarca" class="form-label">Marca</label>
                        <input type="text" name="marca" class="form-control" id="inputMarca" required>
                    </div>
                    <div class="col-md-4">
                        <label for="inputModelo" class="form-label">Modelo</label>
                        <input type="text" name="modelo" class="form-control" id="inputModelo" required>
                    </div>
                    <div class="col-md-2">
                        <label for="inputCon" class="form-label">Portas</label>
                        <select class="form-select" id="inputCon" name="portas">
                            <option>5 PORTAS</option>
                            <option>8 PORTAS</option>
                            <option>16 PORTAS</option>
                            <option>24 PORTAS</option>
                            <option>32 PORTAS</option>
                            <option>48 PORTAS</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inputQtd" class="form-label">Quantidade</label>
                        <input type="number" name="qtd" class="form-control" id="inputQtd" required>
                    </div>
                    <div class="col-md-6">
                        <label for="NameGrad" class="form-label">Destino</label>
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
                        <label for="func" class="form-label">Funciona</label>
                        <div class="input-group">
                            <input type="radio" class="btn-check" value="sim" name="funci_check" id="funci_check_y" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="funci_check_y">Sim</label>
                                                    
                            <input type="radio" class="btn-check" value="nao" name="funci_check" id="funci_check_n" autocomplete="off">
                            <label class="btn btn-outline-primary" for="funci_check_n">Não</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" name="obs" placeholder="Observações do sistema" id="floatingTextarea" style="height: 200px"></textarea>
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