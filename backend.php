<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
input:invalid {border-color: red;}
input:valid {border-color: green;}
</style>
</head>
<body>

<?php
// Define las variables y las inicializa a un valor vacío
$telefonoErr = "";
$telefono = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validación del Teléfono
    if (empty($_POST["telefono"])) {
        $telefonoErr = "El teléfono es obligatorio.";
    } else {
        $telefono = test_input($_POST["telefono"]);
        // Chequea si el formato del teléfono es válido
        if (!preg_match("/^\d{10}$/", $telefono)) {
            $telefonoErr = "Número de teléfono no válido.";
        }
    }
}

// Función para sanear y limpiar los datos de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Formulario de Validación</h2>
<p><span class="error">* Campos obligatorios</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Teléfono: <input type="text" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>">
    <span class="error">* <?php echo $telefonoErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Enviar">
</form>

<?php
// Muestra los datos si todos los campos son válidos
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nombreErr) && empty($apellidoErr) && empty($emailErr) && empty($telefonoErr)) {
    echo "<h2>Tus Datos:</h2>";
    echo "Nombre: " . $nombre;
    echo "<br>";
    echo "Apellido: " . $apellido;
    echo "<br>";
    echo "Correo Electrónico: " . $email;
    echo "<br>";
    echo "Teléfono: " . $telefono;
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>El formulario tiene errores, por favor corrígelos.</h2>";
}
?>

</body>
</html>
