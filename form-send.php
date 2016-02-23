<?php 
// get inputs by action POST
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

// required PHPMailer Lib.
require_once('PHPMailerAutoload.php');
 
$mail = new PHPMailer();

$mail->CharSet = 'UTF-8'; // codificação UTF-8, a codificação mais usada recentemente
$mail->SMTPDebug = 1; //mostra a mensagem de debug
 
$mail->isSMTP();  
$mail->Host = 'cpanel0011.hospedagemdesites.ws';
$mail->SMTPAuth = true; 
$mail->Username = 'form@masterbondbrasil.com.br'; //Informe o e-mai o completo
$mail->Password = 'nit1049';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465; 

// Passando os dados obtidos pelo formulário para as variáveis abaixo
$nomeremetente     = $Post['nomeremetente'];
$emailremetente    = trim($Post['emailremetente']);
$mensagem          = $Post['mensagem'];
$assunto           = 'Mensagem enviada pelo site Master Bond';
$emaildestinatario = 'design@nitdesign.com.br';/* E-mail que deseja receber a mensagem*/

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<h3>Você recebeu uma mensagem através do site!</h3>';
$mensagemHTML .= '<p>Nome: <b>' . $nomeremetente . '</b></p>';
$mensagemHTML .= '<p>Email: <b>' . $emailremetente . '</b></p>';
$mensagemHTML .= '<p>Mensagem: <b>' . $mensagem . '</b></p>';

$mail->setFrom('form@nitdesign.com.br', 'Mensagem enviada pelo site Master Bond');
$mail->addAddress($emaildestinatario); //Destinatário
/*$mail->addReplyTo('sender@deduzir.me', 'Deduzir.me');*/
/*$mail->addCC('design@nitdesign.com.br');*/
$mail->isHTML(true);  // Set email format to HTML

$mail->Subject  = $assunto . ' - ' . date("d/m/Y") . ' - ' . date("H:i");
$mail->Body     = $mensagemHTML;


if(!$mail->send()) {
    // Set a 500 (internal server error) response code.
    http_response_code(500);
    echo "<div class='alert alert-warning'>Erro ao enviar mensagem!</div>";
    echo "<div class='alert alert-danger'>Erro: " . $mail->ErrorInfo ."</div>";
} else {
    // Set a 200 (okay) response code.
    http_response_code(200);
    echo "<div class='alert alert-success'>Olá <strong>{$nomeremetente}</strong>, sua mensagem foi enviada com sucesso!</div>";
}
