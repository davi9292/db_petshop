<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// JOIN para trazer animal e dono
$sql = "SELECT ag.id_agendamento, ag.procedimento, ag.data_hora, 
               a.nome AS animal, c.nome AS cliente
        FROM agendamentos ag
        JOIN animais a ON ag.id_animal = a.id_animal
        JOIN clientes c ON a.id_cliente = c.id_cliente
        ORDER BY ag.data_hora";
$stmt = $pdo->query($sql);
$agendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendamentos</title>
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
  <h1>Agendamentos</h1>
</header>
<div class="container">
  <a href="adicionar_agenda.php" class="btn" style="margin-bottom:15px; display:inline-block;">+ Novo Agendamento</a>

  <table class="table">
    <tr>
      <th>ID</th>
      <th>Procedimento</th>
      <th>Data</th>
      <th>Animal</th>
      <th>Cliente</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($agendas as $ag): ?>
      <tr>
        <td><?= htmlspecialchars($ag['id_agendamento']) ?></td>
        <td><?= htmlspecialchars($ag['procedimento']) ?></td>
        <td><?= date("d/m/Y H:i", strtotime($ag['data_hora'])) ?></td>
        <td><?= htmlspecialchars($ag['animal']) ?></td>
        <td><?= htmlspecialchars($ag['cliente']) ?></td>
        <td>
          <a class="btn" href="edita_agenda.php?id=<?= $ag['id_agendamento'] ?>">Editar</a>
          <a class="btn" style="background:#dc2626" 
             href="exclui_agenda.php?id=<?= $ag['id_agendamento'] ?>" 
             onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>