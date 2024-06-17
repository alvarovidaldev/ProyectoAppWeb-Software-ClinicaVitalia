<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    //CONEXION A BASE DE DATOS

    require '../../includes/config/database.php';

    $db=conectarDB();
    $idAtencion=$_GET['idAtencion']; 


    $sql="UPDATE atencion
        SET estado='Inactivo' 
        WHERE idAtencion=$idAtencion";
    $resultado=mysqli_query($db,$sql); 


    header('Location: listado.php');
    exit();
?>