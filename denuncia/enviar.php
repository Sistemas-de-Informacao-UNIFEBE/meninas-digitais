<?php
include("db.php");

$nome = !empty($_POST['nome']) ? $_POST['nome'] : null;
$telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : null;
$descricao = $_POST['descricao'];

if (!$descricao) {
    die("Descrição obrigatória.");
}

$stmt = $conn->prepare("INSERT INTO denuncias (nome, telefone, descricao) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $telefone, $descricao);
$stmt->execute();

echo "<script>alert('Denúncia enviada com sucesso!');window.location='index.html';</script>";
?>
