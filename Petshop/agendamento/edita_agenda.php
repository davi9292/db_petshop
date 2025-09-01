<!-- Davi Fabricio - Vinicius Queiroz - Thomas Gabriel  -->
<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID inválido!");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $procedimento = $_POST['procedimento'];
    $data_hora = $_POST['data_hora'];

    $stmt = $pdo->prepare("UPDATE agendamentos SET procedimento=?, data_hora=? WHERE id_agendamento=?");
    $stmt->execute([$procedimento, $data_hora, $id]);

    header("Location: consulta_agenda.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM agendamentos WHERE id_agendamento=?");
$stmt->execute([$id]);
$agenda = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$agenda) {
    die("Agendamento não encontrado!");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Agendamento</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
  <h1>Editar Agendamento</h1>
</header>
<div class="container">
  <form method="post">
    <label>Procedimento:</label>
    <input type="text" name="procedimento" value="<?= htmlspecialchars($agenda['procedimento']) ?>" required>

    <label>Data e Hora:</label>
    <input type="datetime-local" name="data_hora" 
           value="<?= date('Y-m-d\TH:i', strtotime($agenda['data_hora'])) ?>" required>

    <button type="submit">Salvar</button>
  </form>
</div>
</body>
</html>