<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");
 
$id = $_GET['id'] ?? null;
if ($id) {
    // Verifica se tem animais
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM animais WHERE id_cliente=?");
    $stmt->execute([$id]);
    $temAnimais = $stmt->fetchColumn();
 
    if ($temAnimais > 0) {
        echo "Não é possível excluir: o cliente tem animais cadastrados.";
        exit;
    }
 
    // Apaga o cliente se não tiver animais
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id_cliente=?");
    $stmt->execute([$id]);
}
 
header("Location: consulta_cliente.php");
exit;
?>