<?php
// session_start();
// $auth = $_SESSION['login'];
// if (!$auth) {
//     header('Location:/clinica');
// }

require "../../includes/config/database.php";
$db = conectarDB();

if ($_POST) {
    $n = $_POST['nom'];
    $pa = $_POST['pat'];
    $m = $_POST['mat'];
    $t = $_POST['tel'];
    $e = $_POST['em']; // Nuevo campo para el email
    $p = $_POST['pas']; // Nuevo campo para la contraseña
    $pashash=password_hash($p,PASSWORD_DEFAULT);
    var_dump($pashash);

    // Insertar datos del nuevo medico
    $con_sql = "INSERT INTO administrador (aNombre, aPaterno, aMaterno, aTelefono, email, pasword, estado) VALUES ('$n', '$pa', '$m', '$t', '$e', '$pashash','Activo')";
    $res = mysqli_query($db, $con_sql);

    if ($res) {
        echo "<script> alert ('Se registró el nuevo administrador'); </script>";
    } else {
        echo "<script> alert ('No se pudo registrar al nuevo administrador'); </script>";
    }
}
?>