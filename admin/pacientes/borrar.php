<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    //CONEXION A BASE DE DATOS

    require '../../includes/config/database.php';
    $db=conectarDB();

    //NO SE USA $_SESSION['idUsuario'] YA QUE ESTA SECCIÓN TAMBIEN SERÁ LLAMADA DESDE EL LISTADO

    $idPaciente=$_GET['idPaciente'];
    

    //RECUPERACIÓN DE DATOS PARA MODIFICACIÓN

    $sql="UPDATE paciente
        SET estado='Inactivo' 
        WHERE idPaciente=$idPaciente";
    $resultado=mysqli_query($db,$sql);

    header('Location: listado.php');
    exit();
?>