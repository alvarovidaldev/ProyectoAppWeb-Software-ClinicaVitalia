<?php 
//sacar todo este if hacerlo manualmente en cada pagina
    if(!isset($_SESSION)){
        session_start();
    }
    $auth=$_SESSION['login']?? false;
    //var_dump($auth);

    $tipo = $_SESSION['tipo']?? false; //TIPO
?>
<!-- SCRIPT PARA LLAMAR AL JAVASCRIPT -->
<script src="/clinica/build/js/custom.js"></script>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gentium+Book+Basic&display=swap">
  
    <!-- ACERCA DE -->
    <link rel="stylesheet" href="/clinica/paginas/acercade/estilode1.css">

    <!-- SEVICIOS -->
    <link rel="stylesheet" href="/clinica/paginas/especialidad/estilo.css">

    <!-- ESPECIALIDADES -->
	<link rel="stylesheet" href="/clinica/paginas/medicos/css/style.css">

    <!-- CONTACTO -->
    <link rel="stylesheet" href="/clinica/paginas/contacto/style.css">

    <!-- HEADER/FOOTER -->
    <link rel="stylesheet" href="/clinica/build/css/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="/clinica/build/img/logo_cuadrado_sin_fondo.png">

    <link rel="stylesheet" href="/clinica/build/css/transitions.css">

    <link rel="stylesheet" href="/clinica/build/css/sweetalert2.min.css">


</head>
    <!-- SCRIPT PARA LAS TRANSICIONES -->
    <script src="/clinica/build/js/transitions.js"></script>

    <!-- SCRIPT PARA EL SWEET ALERT 2 -->
    <script src="/clinica/build/js/sweetalert2.all.min.js"></script>

    <header class="header<?php echo $inicio?"_inicio":"";?>">
        <nav class="navbar" id="navbar">

            <div class="logo">
                <a href="/clinica/index.php"><img src="/clinica/build/img/logo_largo_sin_fondo.png"></a>
            </div>
            <i class="fa-solid fa-bars" id="btn_menu"></i>
            <!-- MENU -->

            <div id="back_menu"></div>
            <div class="menu" id="menu1">
                <ul>
                <a href="/clinica/paginas/acercade/acercade.php" class="menu_item">Acerca de Vitalia</a>
                <a href="/clinica/paginas/especialidad/especialidad.php" class="menu_item">Especialidades</a>
                <a href="/clinica/paginas/medicos/medicos.php" class="menu_item">Medicos</a>
                <a href="/clinica/paginas/contacto/contacto.php" class="menu_item">Contacto</a>
                <?php
                    if($auth): ?>
                    <a href="/clinica/admin/cerrarsesion.php" class="menu_item">Cerrar Sesion</a>
                <?php
                    else: ?>

                    <a href="/clinica/login.php" class="menu_item">Iniciar Sesion</a>
                    <?php 
                    endif; ?>
                <!-- HOME SEGUN TIPO DE USUARIO // CONDICIONAL TERNARIA-->  
                <a class="menu_item" href="/clinica/<?=($tipo=='administradores'?'admin/indexA':($tipo=='medicos'?'admin/indexM':($tipo=='pacientes'?'admin/indexP':'index')))?>.php"> <i class="fa-solid fa-house-chimney-user fa-xl"></i></a> 

                </ul>
            </div>
        </nav>
        <?php
            if($inicio){
                echo '<h1 class="eslogan">Más que una Clínica, un Hogar para Tu Bienestar</h1>';
            }
        ?>
    </header>


    
   