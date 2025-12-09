<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// CÓDIGO CORRETO: Incluir 'admin/'
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

function enviar_notificacao_admin_smtp($detalhes_denuncia) {
    
    $mail = new PHPMailer(true); 
    
    try {

        $mail->CharSet = 'UTF-8';

        $mail->isSMTP();                                       
        $mail->Host       = 'smtp.gmail.com';           
        $mail->SMTPAuth   = true;                              
        $mail->Username   = 'thaisdesouzaa24@gmail.com';  
        $mail->Password   = 'acgplcsvmafgydqb';         
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;                               

        // Configurações de Remetente e Destinatário
        $mail->setFrom('thaisdesouzaa24@gmail.com', 'Sistema de Denúncias'); // Remetente
        $mail->addAddress('thais.souza@unifebe.edu.br', 'Administrador'); // <-- DESTINATÁRIO (ADMIN)
                $mail->isHTML(true);                                  
        $mail->Subject = '⚠️ NOVA DENÚNCIA ANÔNIMA REGISTRADA';

        // Conteúdo do Email em HTML
        $corpo_email = "
            <html>
            <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
                <h2>Nova Denúncia Recebida</h2>
                <p>Uma nova denúncia anônima foi registrada no sistema. Por favor, analise o mais rápido possível.</p>
                <div style='border: 1px solid #ccc; padding: 15px; border-radius: 5px; background-color: #f9f9f9;'>
                    <p><strong>Data/Hora:</strong> " . date('d/m/Y H:i:s') . "</p>
                    <p><strong>Nome (Opcional):</strong> " . ($detalhes_denuncia['nome'] ?? 'Não informado') . "</p>
                    <p><strong>Email (Opcional):</strong> " . ($detalhes_denuncia['email'] ?? 'Não informado') . "</p>
                    <p><strong>Telefone (Opcional):</strong> " . ($detalhes_denuncia['telefone'] ?? 'Não informado') . "</p>
                    <hr>
                    <p><strong>Descrição do Relato:</strong></p>
                    <p style='white-space: pre-line;'>" . htmlspecialchars($detalhes_denuncia['descricao']) . "</p>
                </div>
                <p><a href='http://seusistema.com/admin/painel.php' style='display: inline-block; padding: 10px 20px; background-color: #004d9c; color: white; text-decoration: none; border-radius: 5px;'>Acessar Painel Admin</a></p>
            </body>
            </html>
        ";
        
        $mail->Body = $corpo_email;
        $mail->AltBody = "Nova denúncia registrada. Acesse o painel admin para mais detalhes.";

        $mail->send();
        return true;

    } catch (Exception $e) {
        // Você pode logar o erro para depuração
        error_log("Erro ao enviar email: {$mail->ErrorInfo}");
        return false;
    }
}
?>