<?php
include('database/connection.php');

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM `all_computers` WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$dados = $result->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./media/pc_2291988.png" type="image/png">
    <link href="./styles.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Ips Mallet - Editor de Registros</title>
</head>
<body data-bs-theme="dark">
    <div class="card">
        <div class="card-header h-25">
            <div class="row">
                <div class="col-md-6">
                    <h2>Editor de Registros</h2>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <a href="./index.php" role="button" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form class="row" action="database/update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($dados['id']); ?>">
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 ps-3">ID</span>
                        <input type="text" name="user_id" class="form-control w-75" value="<?php echo htmlspecialchars($dados['id']);?>" readonly disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 ps-4">Local</span>
                        <select class="form-select" id="inputLocal" name="loc">
                            <?php
                            $sql_lc = "SELECT secsu FROM `local`";
                            $result = $conn->query($sql_lc);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option" . ($row["secsu"] == $dados['local'] ? " selected" : "") . ">" . htmlspecialchars($row["secsu"]) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-50">Pos/Grad</span>
                        <select class="form-select w-50" id="inputPg" name="posgrad">
                            <?php
                            $sql_pg = "SELECT pg FROM `posgrad`";
                            $result = $conn->query($sql_pg);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option" . ($row["pg"] == $dados['pos'] ? " selected" : "") . ">" . htmlspecialchars($row["pg"]) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 text-center ps-4">Nome</span>
                        <input type="text" name="user_name" class="form-control w-50" value="<?php echo htmlspecialchars($dados['user']); ?>" required>
                    </div>
                </div>
                <div class="col-md-5 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 ps-3">Processador</span>
                        <input type="text" name="cpu" class="form-control w-75" value="<?php echo htmlspecialchars($dados['cpu']); ?>">
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-50 ps-5">Sistema</span>
                        <select class="form-select" id="inputSystem" name="system">
                            <?php
                            $sql_os = "SELECT OS FROM `system`";
                            $result = $conn->query($sql_os);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option" . ($row["OS"] == $dados['os'] ? " selected" : "") . ">" . htmlspecialchars($row["OS"]) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 ps-1">RAM</span>
                        <select class="form-select" id="inputRam" name="ram">
                            <?php
                            $sql_ram = "SELECT memoria_ram FROM `memram`";
                            $result = $conn->query($sql_ram);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option" . ($row["memoria_ram"] == $dados['ram'] ? " selected" : "") . ">" . htmlspecialchars($row["memoria_ram"]) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 ps-1">ROM</span>
                        <select class="form-select" id="inputRom" name="rom">
                            <?php
                            $sql_rom = "SELECT memoria_rom FROM `rom`";
                            $result = $conn->query($sql_rom);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option" . ($row["memoria_rom"] == $dados['rom'] ? " selected" : "") . ">" . htmlspecialchars($row["memoria_rom"]) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-30 ps-1">Endereço IP</span>
                        <input type="text" name="ip_addr" class="form-control" id="inputIp" aria-describedby="btnIp" value="<?php echo htmlspecialchars($dados['ip_addr']); ?>" required>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-30 ps-1">Endereço MAC</span>
                        <input type="text" name="mac_addr" class="form-control" id="inputMac" aria-describedby="btnMac" value="<?php echo htmlspecialchars($dados['mac_addr']); ?>" required>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-30 ps-1">Número Ficha</span>
                        <input type="text" name="n_ficha" class="form-control" id="inputFicha" value="<?php echo htmlspecialchars($dados['n_ficha']); ?>" required>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-30 ps-1">Número Lacre</span>
                        <input type="text" name="n_lacre" class="form-control" id="inputLacre" value="<?php echo htmlspecialchars($dados['n_lacre']); ?>" required>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="form-floating">
                        <textarea class="form-control" name="obs" placeholder="Observações do sistema" id="floatingTextarea" style="height: 200px"><?php echo htmlspecialchars($dados['obs']); ?></textarea>
                        <label for="floatingTextarea">Observação</label>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <input type="hidden" name="update" value="1">
                    <button type="submit" class="btn btn-outline-primary w-100 fs-4" name="save_btn">
                        <i class="fa-solid fa-floppy-disk icon-editor-btn"></i>
                    </button>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-center">
                    Sistema criado por Sd Naysinger - 2024
                </div>
            </form>
    </div>

    <script src="./script.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0635eb955e.js" crossorigin="anonymous"></script>
</body>
</html>
