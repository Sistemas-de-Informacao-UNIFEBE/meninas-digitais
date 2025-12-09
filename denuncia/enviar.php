<?php
include("db.php");
include("enviar-email.php"); 

$nome = !empty($_POST['nome']) ? $_POST['nome'] : null;
$email = !empty($_POST['email']) ? $_POST['email'] : null;
$telefone = !empty($_POST['telefone']) ? $_POST['telefone'] : null;
$descricao = $_POST['descricao'] ?? ''; 

if (empty($descricao)) {
    echo "<script>alert('ERRO: A descrição da denúncia é obrigatória.');window.location='index.html';</script>";
    exit;
}

$stmt = $conn->prepare("INSERT INTO denuncias (nome,email, telefone, descricao) VALUES (?, ?, ? , ?)");
$stmt->bind_param("ssss", $nome, $email, $telefone, $descricao); 

if ($stmt->execute()) {
    
    $dados_para_email = [
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'descricao' => $descricao 
    ];

    enviar_notificacao_admin_smtp($dados_para_email); 
    
    $stmt->close();
    $conn->close();

    echo "<script>alert('Denúncia enviada com sucesso! Agradecemos sua contribuição.');window.location='index.html';</script>";
    exit;

} else {
    
    $stmt->close();
    $conn->close();
    
    echo "<script>alert('ERRO ao registrar a denúncia no banco de dados.');window.location='index.html';</script>";
    exit;
}
?>