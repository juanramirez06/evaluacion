<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Solicitud de usuario</title>
</head>
<body>
    <h2>Formulario de Solicitud</h2>
    <form action="usuario.php" method="post">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br><br>

        <label for="email">Correo Electrónico:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="mensaje">Mensaje:</label><br>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea><br><br>

     
        <label for="id_soli">problema de Solicitud:</label><br>
        <select id="id_soli" name="id_soli">
            <?php
            // Configurar la conexión a la base de datos (cambia los valores según tu configuración)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "evaluacion"; // Nombre de tu base de datos

            // Consultar la base de datos para obtener los valores de id_soli
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }
            $sql = "SELECT id_soli FROM solicitudes"; // Cambiar 'solicitudes' por el nombre de tu tabla que contiene los nombres
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["id_soli"]."'>".$row["id_soli"]."</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>

        <input type="submit" value="Enviar Solicitud">
    </form>

    <?php
    // Verificar si se han enviado datos mediante el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
        $mensaje = isset($_POST['mensaje']) ? $_POST['mensaje'] : '';
        $id_soli = isset($_POST['id_soli']) ? $_POST['id_soli'] : '';

        // Crear una conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Preparar la consulta SQL para insertar la solicitud
        $sql = "INSERT INTO evaluacion (nombre, apellido, email, telefono, mensaje, id_soli, estado) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$mensaje', '$id_soli', 'pendiente')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "<p>Solicitud enviada correctamente</p>";
        } else {
            echo "<p>Error al enviar la solicitud: " . $conn->error . "</p>";
        }

        // Cerrar la conexión
        $conn->close();
    }
    ?>
</body>
</html>
