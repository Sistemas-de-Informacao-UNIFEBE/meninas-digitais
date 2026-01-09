<?php
$host = "localhost";
$user = "root"; // o mesmo usuário que você usa no HeidiSQL
$pass = "";     // coloque aqui a senha do MySQL (se houver)
$dbname = "denuncias_db";

$conn = new mysqli($host, $user, $pass, $dbname);
{
    // 1. Prepara e executa a consulta para buscar o hash da senha, filtrando apenas pelo usuário.
    $stmt = $conn->prepare("SELECT senha FROM admin WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hash_armazenado = $row['senha'];

        // 2. Verifica a senha usando a função segura password_verify().
        // Esta função sabe como decodificar o prefixo $2y$10$ e verificar o Bcrypt.
        if (password_verify($senha, $hash_armazenado)) {
            $_SESSION['admin'] = $usuario;
            header("Location: painel.php");
            exit;
        } else {
            // A senha digitada não corresponde ao hash.
            $erro = "Usuário ou senha inválidos!";
        }
    } else {
        // O usuário não foi encontrado.
        $erro = "Usuário ou senha inválidos!";
    }
    // Fecha o statement
    $stmt->close();
}
// O restante do HTML permanece o mesmo
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Login - Admin</title>
<link rel="stylesheet" href="../../style.css" />
</head>
<body>
  <div class="formDenuncia">
    <form method="POST">

    <h3 class="titulo-denuncia">Login</h3>

    <input type="text" name="usuario" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <div class = "botao-denuncia">
    <button type="submit">Entrar</button>
</div>
    <?php if(isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>
  </form>
</div>
</body>
</html>
