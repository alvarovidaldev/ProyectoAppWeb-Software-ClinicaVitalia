<?php
//conectar con la base
require '../../includes/config/database.php';
$db=conectarDB();
//obtener los datos para almacenar
$em="correo@clases.com";
$pas="123456";

$pashash=password_hash($pas,PASSWORD_DEFAULT);
var_dump($pashash);

//consulta de insercion en sql
$con_sql="INSERT INTO usuarios (email,pasword) values('$em','$pashash')";
echo $con_sql;


//almacenamiento en la BD
mysqli_query($db,$con_sql);

$con_sql="SELECT idUsuario FROM usuarios WHERE email=$em ";
$res = mysqli_query($db,$con_sql);
if($res->num_rows > 0){
    $idUsuario = mysqli_fetch_array($res);
    $con_sql="INSERT INTO medicos  ";  //INSERT INTO usuarios (email,pasword) values('$em','$pashash') ADAPTAR
    switch ($idUsuario['tipo']){
        case 'administrador':
            include "../administradores/crear.php";
            break;
        case 'medico':
            include "../medicos/crear.php";
            break;
        case 'paciente':
            include "../pacientes/crear.php";
            break;
    }

}

?>