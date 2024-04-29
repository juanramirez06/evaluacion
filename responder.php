<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta</title>
</head>
<body>
    <h1>Respuesta</h1>
    <?php
    // Verificar si se recibieron los datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['mensaje'])) {
            $nombre = htmlspecialchars($_POST['nombre']);
            $email = htmlspecialchars($_POST['email']);
            $mensaje = htmlspecialchars($_POST['mensaje']);

            // Mostrar los datos recibidos
            echo "<p>Gracias por enviar el formulario.</p>";
            echo "<p>Nombre: $nombre</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Mensaje: $mensaje</p>";
        } else {
            // Si no se recibieron datos, mostrar un mensaje de error
            echo "<p>No se recibieron datos del formulario.</p>";
        }
    } else {
        // Si no es una solicitud POST, redirigir al formulario
        header("Location: formulario.html");
        exit;
    }
    ?>
</body>
</html>
