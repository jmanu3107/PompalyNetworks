<?php
// Configuración del correo
$to = "pompalynetworks@gmail.com";
$subject = "Nuevo mensaje desde Pompaly Networks";

// Obtener los datos del formulario
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject_form = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Validar que los campos no estén vacíos
if (empty($name) || empty($email) || empty($subject_form) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos']);
    exit;
}

// Construir el cuerpo del correo
$body = "Nuevo mensaje desde el formulario de contacto\n\n";
$body .= "Nombre: " . $name . "\n";
$body .= "Email: " . $email . "\n";
$body .= "Asunto: " . $subject_form . "\n";
$body .= "Mensaje:\n" . $message . "\n";

// Encabezados del correo
$headers = "From: no-reply@pompaly.com\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Enviar el correo
if (mail($to, $subject, $body, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al enviar el mensaje. Verifica que tu hosting tenga PHP y mail() habilitado.']);
}
?>
