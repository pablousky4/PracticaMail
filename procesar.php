<?php
echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Envío</title>
    <style>
        .imagen-container {
            display: inline-block;
            margin-right: 50px; 
        }
    </style>
</head>
<body>
HTML;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carpetaSeleccionada = $_POST["carpeta"];
    $imagenes = glob("$carpetaSeleccionada/*.jpg");

    if (!empty($imagenes)) {
        echo "<h1>Enviar Email</h1>";
        echo "<form action=\"enviar_email.php\" method=\"post\">";
        echo "<label>Selecciona una imagen:</label>";

        foreach ($imagenes as $imagen) {
            echo "<div class='imagen-container'>";
            echo "<img src=\"$imagen\" alt=\"imagen\" width=\"200\" height=\"200\"><br>";
            echo "<input type=\"radio\" name=\"imagen\" value=\"$imagen\">";
            echo "</div>";
        }
        echo "<br><br>";
        include "conexion.php";

        $result = $conexion->query("SELECT Nombre, Apellidos, email FROM contactos");
        echo "<br>";
        echo "<label for=\"contactos\">Selecciona contactos:</label>";
        echo "<select name=\"contactos[]\" id=\"contactos\" multiple>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=\"{$row['email']}\">{$row['Nombre']} {$row['Apellidos']}</option>";
        }
        echo "</select>";

        $conexion->close();

        echo "<br><br>";
        echo "<label for=\"asunto\">Asunto del email:</label>";
        echo "<input type=\"text\" name=\"asunto\" id=\"asunto\"><br>";
        echo "<br><label for=\"cuerpo\">Cuerpo del email:</label>";
        echo "<textarea name=\"cuerpo\" id=\"cuerpo\" rows=\"4\" cols=\"50\"></textarea><br>";
        echo "<br><input type=\"submit\" value=\"Enviar\">";
        echo "</form>";
        echo "<br><br>";
        echo "<a href='index.php'>Volver</a>";
    } else {
        echo "<p>No hay imágenes en la carpeta seleccionada.</p>";
        echo "<a href='index.php'>Volver</a>";
    }
} else {
    echo "<p>Error en la solicitud.</p>";
    echo "<a href='index.php'>Volver</a>";
}

echo <<<HTML
</body>
</html>
HTML;
?>
