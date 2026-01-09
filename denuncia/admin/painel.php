<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
include("../db.php");
$result = $conn->query("SELECT * FROM denuncias ORDER BY data_envio DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Painel Administrativo</title>
<style>
body { font-family: Arial; background: #f9f9f9; padding: 20px; }
table { border-collapse: collapse; width: 100%; background: white; }
th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
th { background: #333; color: white; }
a { text-decoration: none; color: #333; }
.logout { float: right; background: #e74c3c; color: white; padding: 5px 10px; border-radius: 4px; }
</style>
</head>
<body>
  <h2>Painel Administrativo</h2>
  <a href="logout.php" class="logout">Sair</a>
  <table>
    <tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Descrição</th><th>Data</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nome'] ?: '<i>Anônimo</i>' ?></td>
        <td><?= $row['email'] ?: '<i>Não informado</i>' ?></td>
        <td><?= $row['telefone'] ?: '<i>Não informado</i>' ?></td>
        <td><?= nl2br(htmlspecialchars($row['descricao'])) ?></td>
        <td><?= $row['data_envio'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
