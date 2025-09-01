<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
// Conexão
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// Busca animais (com o nome do dono)
$stmt = $pdo->query("
    SELECT a.id_animal, a.nome AS animal, c.nome AS dono
    FROM animais a
    JOIN clientes c ON a.id_cliente = c.id_cliente
    ORDER BY a.nome
");
$animais = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $procedimento = $_POST['procedimento'] ?? '';
    $data_hora = $_POST['data_hora'] ?? '';
    $id_animal = $_POST['id_animal'] ?? '';

    if (!empty($procedimento) && !empty($data_hora) && !empty($id_animal)) {
        $sql = "INSERT INTO agendamentos (procedimento, data_hora, id_animal) 
                VALUES (:procedimento, :data_hora, :id_animal)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':procedimento' => $procedimento,
            ':data_hora'    => $data_hora,
            ':id_animal'    => $id_animal
        ]);

        // Redireciona para a lista de agendamentos
        header("Location: consulta_agenda.php");
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
  <title>Novo Agendamento</title>
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
  <h1>Novo Agendamento</h1>
</header>
<div class="container">
  <?php if (!empty($erro)): ?>
    <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
  <?php endif; ?>

  <form method="POST" class="form">
    <label for="procedimento">Procedimento:</label>
    <input type="text" id="procedimento" name="procedimento" required>

    <label for="data_hora">Data e Hora:</label>
    <input type="datetime-local" id="data_hora" name="data_hora" required>

    <label for="id_animal">Animal:</label>
    <select id="id_animal" name="id_animal" required>
      <option value="">-- Selecione --</option>
      <?php foreach ($animais as $a): ?>
        <option value="<?= $a['id_animal'] ?>">
          <?= htmlspecialchars($a['animal']) ?> (Dono: <?= htmlspecialchars($a['dono']) ?>)
        </option>
      <?php endforeach; ?>
    </select>

    <button type="submit" class="btn">Agendar</button>
  </form>
</div>
</body>
</html>
