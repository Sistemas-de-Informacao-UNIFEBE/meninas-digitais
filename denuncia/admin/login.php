<?php
$host = "localhost";
$user = "root"; // o mesmo usuário que você usa no HeidiSQL
$pass = "";     // coloque aqui a senha do MySQL (se houver)
$dbname = "denuncias_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("❌ Erro de conexão: " . $conn->connect_error);
}

echo "✅ Conexão bem-sucedida com o banco: " . $dbname;
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Login - Admin</title>
<style>
body { font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; background: #eee; }
form { background: white; padding: 20px; border-radius: 10px; width: 300px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
input, button { width: 100%; margin-top: 10px; padding: 8px; }
button { background: #333; color: white; border: none; }
</style>
</head>
<body>
  <form method="POST">
    <h3>Login Admin</h3>
    <input type="text" name="usuario" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
    <?php if(isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>
  </form>
</body>
</html>
