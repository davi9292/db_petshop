<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
// Conexão
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// Busca os clientes para o select de donos
$stmt = $pdo->query("SELECT id_cliente, nome FROM clientes ORDER BY nome");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'] ?? '';
    $raca = $_POST['raca'] ?? '';
    $id_cliente = $_POST['id_cliente'] ?? '';

    if (!empty($nome) && !empty($raca) && !empty($id_cliente)) {
        $sql = "INSERT INTO animais (nome, raca, id_cliente) 
                VALUES (:nome, :raca, :id_cliente)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':raca' => $raca,
            ':id_cliente' => $id_cliente
        ]);

        // Redireciona para a lista de animais
        header("Location: consulta_animal.php");
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
  <title>Adicionar Animal</title>
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
  <h1>Novo Animal</h1>
</header>
<div class="container">
  <?php if (!empty($erro)): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>

  <form method="POST" class="form">
    <label for="nome">Nome do Animal:</label>
    <input type="text" id="nome" name="nome" required>

    <label for="raca">Raça:</label>
    <input type="text" id="raca" name="raca" required>

    <label for="id_cliente">Dono:</label>
    <select id="id_cliente" name="id_cliente" required>
      <option value="">-- Selecione o dono --</option>
      <?php foreach ($clientes as $c): ?>
        <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
      <?php endforeach; ?>
    </select>

    <button type="submit" class="btn">Cadastrar</button>
  </form>
</div>
</body>
</html>
