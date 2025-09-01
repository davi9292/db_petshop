<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
// Conexão
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'] ?? '';
    $endereco = $_POST['endereco'] ?? '';

    if (!empty($nome) && !empty($endereco)) {
        $sql = "INSERT INTO clientes (nome, endereco) VALUES (:nome, :endereco)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':endereco' => $endereco
        ]);

        // Redireciona de volta para a lista de clientes
        header("Location: consulta_cliente.php");
        exit;
    } else {
        $erro = "Preencha todos os campos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Cliente</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
  <nav class="navbar">
    <a href="../cliente/consulta_cliente.php">Clientes</a>
    <a href="../animal/consulta_animal.php">Animais</a>
    <a href="../agendamento/consulta_agenda.php">Agendamentos</a>
    <a href="../index.php">Início</a>
  </nav>
  <h1>Novo Cliente</h1>
</header>
<div class="container">
  <?php if (!empty($erro)): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>

  <form method="POST" class="form">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="endereco">Endereço:</label>
    <input type="text" id="endereco" name="endereco" required>

    <button type="submit" class="btn">Cadastrar</button>
  </form>
</div>
</body>
</html>
