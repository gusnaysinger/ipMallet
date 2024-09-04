<?php
include('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["marca"]) && isset($_POST["modelo"]) && isset($_POST["loc"])) {
        $marca = strtoupper($_POST["marca"]);
        $modelo = strtoupper($_POST["modelo"]);
        //$entradas = $_POST["checkentdvi"] . ", " . $_POST["checkentvga"] . ", " . $_POST["checkenthdmi"] . ", " . $_POST["checkentdp"];
        $loc = $_POST["loc"];
        $obs = strtoupper($_POST["obs"]);
        $work = strtoupper($_POST["funci_check"]);

        $entradas = array();
        if (isset($_POST["checkentdvi"])) {
            $entradas[] = $_POST["checkentdvi"];
        }
        if (isset($_POST["checkentvga"])) {
            $entradas[] = $_POST["checkentvga"];
        }
        if (isset($_POST["checkenthdmi"])) {
            $entradas[] = $_POST["checkenthdmi"];
        }
        if (isset($_POST["checkentdp"])) {
            $entradas[] = $_POST["checkentdp"];
        }
        // Agora, juntamos os valores usando implode para colocar vírgulas entre eles
        $entrada_final = implode(", ", $entradas);
        

        $sql_insert = "INSERT INTO all_monitor (marca, modelo, entrada, destino, obs, funciona)
                        VALUES ('$marca', '$modelo', '$entrada_final', '$loc', '$obs', '$work')";
        
        
        //echo $sql_insert;
        if ($conn->query($sql_insert) === TRUE) {
            //echo $sql_insert;
            echo"<script language=\"javascript\" type=\"text/javascript\">";
            echo"alert(\"Monitor cadastrado com sucesso!\");window.location.href=\"../regMonitor.php\"</script>\"";
        } else {
            echo "Erro ao inserir registro: " . $conn->error;
        }
        $conn->close();
    } else {
        echo "error :/";
    }
} else {
    echo "request method not post";
}
?>