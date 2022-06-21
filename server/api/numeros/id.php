<?php
require_once '../../models/inicia.php';
header("Access-Control-Allow-Origin: *");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $UsuarioID = isset($_GET['UsuarioID']) ? (int) $_GET['UsuarioID'] : null;
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("SELECT * FROM `numeros` WHERE 1");
        $stmt->execute();
        while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
            $jsonResultado[] = $resultado;
        }
        echo json_encode($jsonResultado);
        $PDO = desconecta_bd();
        break;
    case 'POST':
        $Numero = isset($_POST['Numero']) ? $_POST['Numero'] : null;
        $UsuarioID = isset($_POST['UsuarioID']) ? $_POST['UsuarioID'] : null;
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("INSERT INTO `numeros`(`Numero`, `UsuarioID`)
         VALUES (:Numero,:UsuarioID)");
        $stmt-> bindParam('Numero',$Numero);
        $stmt-> bindParam('UsuarioID',$UsuarioID);
        if ($stmt->execute()) {
            echo json_encode("successo");
        } else echo json_encode("falha");
        $PDO = desconecta_bd();
        break;
    case 'PUT':
        $NumeroID = isset($_GET['NumeroID']) ? (int) $_GET['NumeroID'] : null;
        if (empty($NumeroID)) {
            echo "O NumeroID é obrigatório";
            exit;
        }
        $JsonNumero = file_get_contents('php://input');
        $Numero = json_decode($JsonNumero, false);
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("UPDATE `numeros` SET `Numero`=:Numero
         WHERE NumeroID = :NumeroID");
        $stmt-> bindParam('NumeroID',$NumeroID);
        $stmt-> bindParam('Numero',$Numero->Numero);
        if ($stmt->execute()) {
            echo json_encode("successo");
        } else echo json_encode("falha");
        $PDO = desconecta_bd();
        break;
    case 'DELETE':
        $NumeroID = isset($_GET['NumeroID']) ? (int) $_GET['NumeroID'] : null;
        if (empty($NumeroID)) {
            echo "O id do usuário é obrigatório";
            exit;
        }
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("DELETE FROM `numeros` WHERE NumeroID = :NumeroID");
        $stmt->bindParam(':NumeroID',$NumeroID,PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode("successo");
        } else echo json_encode("falha");
        desconecta_bd();
        break;
    
    default:
        echo "parece que não conseguimos identificar seu request";
        break;
}