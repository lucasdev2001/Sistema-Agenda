<?php
require_once '../../models/inicia.php';
header("Access-Control-Allow-Origin: http://localhost:3000");
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("SELECT * FROM `Usuarios` WHERE 1");
        $stmt->execute();
        while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
            $jsonResultado[] = $resultado;
        }
        echo json_encode($jsonResultado);
        $PDO = desconecta_bd();
        break;
    case 'POST':
        $NomeUsuario = isset($_POST['NomeUsuario']) ? $_POST['NomeUsuario'] : null;
        if (empty($NomeUsuario)) {
            echo "O nome de usuário é obrigatório";
            exit;
        }
        $PDO = conecta_bd();
        $stmt = $PDO->prepare("INSERT INTO `usuarios`(`NomeUsuario`) VALUES (:NomeUsuario)");
        $stmt-> bindParam('NomeUsuario',$NomeUsuario);
        if ($stmt->execute()) {
            echo json_encode("successo");
        } else echo json_encode("falha");
        $PDO = desconecta_bd();
        break;
    
    default:
        echo "parece que não conseguimos identificar seu request";
        break;
}