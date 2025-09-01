<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
// Conexão
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// Verifica se um ID foi passado
$id = $_GET['id'] ?? null;
if ($id) {
    // Verifica se o cliente possui animais
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM animais WHERE id_cliente = ?");
    $stmt->execute([$id]);
    $temAnimais = $stmt->fetchColumn();

    if ($temAnimais > 0) {
        echo "<script>
                alert('Não é possível excluir: o cliente possui animais cadastrados.');
                window.location.href='consulta_cliente.php';
              </script>";
        exit;
    }

    // Se não tiver animais, exclui o cliente
    $stmt = $pdo->prepare("DELETE FROM clientes WHERE id_cliente = ?");
    $stmt->execute([$id]);

    header("Location: consulta_cliente.php");
    exit;
}

// Busca todos os clientes
$stmt = $pdo->query("SELECT * FROM clientes ORDER BY id_cliente");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Clientes</title>
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
  <h1>Clientes Cadastrados</h1>
</header>

<a href="adicionar_cliente.php" class="btn" style="margin-bottom:15px; display:inline-block;">+ Novo Cliente</a>

<div class="container">
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Endereço</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($clientes as $c): ?>
      <tr>
        <td><?= htmlspecialchars($c['id_cliente']) ?></td>
        <td><?= htmlspecialchars($c['nome']) ?></td>
        <td><?= htmlspecialchars($c['endereco']) ?></td>
        <td>
          <a class="btn" href="edita_cliente.php?id=<?= $c['id_cliente'] ?>">Editar</a>
          <a class="btn" style="background:#dc2628" 
             href="../cliente/exclui_cliente.php?id=<?= $c['id_cliente'] ?>" 
             onclick="return confirm('Certeza que deseja excluir?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>
