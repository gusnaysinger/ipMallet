<?php
include('database/connection.php');

$id = intval($_GET['id']);
$db = $_GET['db'];
$web = $_GET['web'];
$stmt = $conn->prepare("SELECT * FROM `$db` WHERE id = ?");
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
                    <a href="./<?php echo $web; ?>.php" role="button" class="btn btn-outline-secondary">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form class="row" action="database/updategeral.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($dados['id']); ?>">
                <div class="col-md-2">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 ps-3">ID</span>
                        <input type="text" name="user_id" class="form-control w-75" value="<?php echo htmlspecialchars($dados['id']);?>" readonly disabled>
                    </div>
                </div>
                <div class="col-md-4">
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
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 text-center ps-4">Marca</span>
                        <input type="text" name="marca" class="form-control w-50" value="<?php echo htmlspecialchars($dados['marca']); ?>" required>
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-25 ps-3">Modelo</span>
                        <input type="text" name="modelo" class="form-control w-75" value="<?php echo htmlspecialchars($dados['modelo']); ?>">
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <div class="input-group">
                        <span class="input-group-text fs-5 w-15">Funciona</span>
                        <select class="form-select" id="func" name="func">
                            <option <?php if ($dados['funciona'] == 'SIM') echo 'selected'; ?>>SIM</option>
                            <option <?php if ($dados['funciona'] == 'NAO') echo 'selected'; ?>>NÃO</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="form-floating">
                        <textarea class="form-control" name="obs" placeholder="Observações do sistema" id="floatingTextarea" style="height: 200px"><?php echo htmlspecialchars($dados['obs']); ?></textarea>
                        <label for="floatingTextarea">Observação</label>
                    </div>
                </div>
                <input type="hidden" name="web" value="<?php echo $web?>">
                <input type="hidden" name="db" value="<?php echo $db?>">
                <div class="col-12 mt-4">
                    
                    <button type="submit" class="btn btn-outline-primary w-100 fs-4" name="updat">
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
