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
    // $i = $_FILES['imagen']['name']; 
    $e = $_POST['em']; // Nuevo campo para el email
    $p = $_POST['pas']; // Nuevo campo para la contraseña
    $ci =$_POST['ci'];
    $es =$_POST['esp'];
    

    $pashash=password_hash($p,PASSWORD_DEFAULT);
    var_dump($pashash);

    // Insertar datos del nuevo medico
    $con_sql = "INSERT INTO medico (mNombre, mPaterno, mMaterno, mTelefono,especialidad,mCi,imagen,email,pasword,estado) VALUES ('$n', '$pa', '$m', '$t','$es','$ci','defaultDoc.png','$e', '$pashash','Activo')";

    $res = mysqli_query($db,$con_sql);
        if($res){
            if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE){
                $i = mysqli_insert_id($db);
                $tmp=$_FILES['imagen']['tmp_name'];
                @copy($tmp,'imagenes/'.$i);
                $sql = "UPDATE medico SET imagen = '$i' WHERE idMedico = '$i'";
                mysqli_query($db, $sql);
            }
            ?>
            <script>
                alert('Se registro');
                location.href='listadoMedico.php';
            </script>
            <?php
        }
        else
            echo "ERROR";

}
?>