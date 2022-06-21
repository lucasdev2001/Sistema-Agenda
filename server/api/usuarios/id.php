<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST,PUT,DELETE");
require_once '../../models/inicia.php';
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $UsuarioID = isset($_GET['UsuarioID']) ? (int) $_GET['UsuarioID'] : null;
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("SELECT * FROM `Usuarios` WHERE UsuarioID = :UsuarioID");
        $stmt->bindParam(':UsuarioID',$UsuarioID,PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($resultado);
        desconecta_bd();
        break;
    case 'PUT':
        $UsuarioID = isset($_GET['UsuarioID']) ? (int) $_GET['UsuarioID'] : null;
        if (empty($UsuarioID)) {
            echo "O id do usuário é obrigatório";
            exit;
        }
        parse_str(file_get_contents('php://input'), $_PUT);
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("UPDATE `usuarios` SET `NomeUsuario`=:NomeUsuario
         WHERE UsuarioID = :UsuarioID");
        $stmt-> bindParam('UsuarioID',$UsuarioID);
        $stmt-> bindParam('NomeUsuario',$_PUT["NomeUsuario"]);
        if ($stmt->execute()) {
            echo json_encode("successo");
        } else echo json_encode("falha");
        $PDO = desconecta_bd();
        break;
    case 'DELETE':
        $UsuarioID = isset($_GET['UsuarioID']) ? (int) $_GET['UsuarioID'] : null;
        if (empty($UsuarioID)) {
            echo "O id do usuário é obrigatório";
            exit;
        }
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("DELETE FROM `usuarios` WHERE UsuarioID = :UsuarioID ");
        $stmt->bindParam(':UsuarioID',$UsuarioID,PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo json_encode("successo");
        } else echo json_encode("falha");
        desconecta_bd();
        break;
    
    default:
        echo "parece que não conseguimos processar seu requerimento";
        break;
}
?>