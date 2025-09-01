<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM animais WHERE id_animal=?");
    $stmt->execute([$id]);
}

header("Location: consulta_animal.php");
exit;