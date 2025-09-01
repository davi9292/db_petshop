<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID inválido!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];

    $stmt = $pdo->prepare("UPDATE animais SET nome=?, raca=? WHERE id_animal=?");
    $stmt->execute([$nome, $raca, $id]);

    header("Location: consulta_animal.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM animais WHERE id_animal=?");
$stmt->execute([$id]);
$animal = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$animal) {
    die("Animal não foi encontrado :/");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Animal</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
  <h1>Editar Animal</h1>
</header>
<div class="container">
  <form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($animal['nome']) ?>" required>

    <label>Raça:</label>
    <input type="text" name="raca" value="<?= htmlspecialchars($animal['raca']) ?>" required>

    <button type="submit">Salvar</button>
  </form>
</div>
</body>
</html>