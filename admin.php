<!DOCTYPE html>
<html>
<head>
    <title>Formulario de solicitudes</title>
</head>
<body>
    <h2>Formulario enviados de usuarios</h2>
    
</body>
</html>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evaluacion";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT * FROM evaluacion WHERE estado='pendiente'";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
   
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "problema de Solicitud: " . $row["id_soli"] . "<br>"; 
        echo "Nombre: " . $row["nombre"] . "<br>";
        echo "Apellido: " . $row["apellido"] . "<br>";
        echo "Correo Electrónico: " . $row["email"] . "<br>";
        echo "Teléfono: " . $row["telefono"] . "<br>";
        echo "Mensaje: " . $row["mensaje"] . "<br>";
        echo "Hora: " . $row["hora"] . "<br>";
        echo "<form action='responder.php' method='post'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<input type='hidden' name='id_soli' value='" . $row["id_soli"] . "'>"; 
        echo "<textarea name='respuesta' placeholder='Escribe tu respuesta aquí'></textarea><br>";
        echo "<input type='submit' value='Responder'>";
        echo "</form>";
        echo "<hr>";
    }
} else {
    echo "No hay solicitudes pendientes.";
}

// Cerrar la conexión
$conn->close();
?>
