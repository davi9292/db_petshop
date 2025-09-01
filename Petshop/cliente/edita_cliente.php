<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID inválido!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE clientes SET nome=?, endereco=?, telefone=?, email=? WHERE id_cliente=?");
    $stmt->execute([$nome, $endereco, $telefone, $email, $id]);

    header("Location: consulta_cliente.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente=?");
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Cliente não encontrado!");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
  <h1>Editar Cliente</h1>
</header>
<div class="container">
  <form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>

    <label>Endereço:</label>
    <textarea name="endereco" required><?= htmlspecialchars($cliente['endereco']) ?></textarea>

    <label>Telefone:</label>
    <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>

    <button type="submit">Salvar</button>
  </form>
</div>
</body>
</html>