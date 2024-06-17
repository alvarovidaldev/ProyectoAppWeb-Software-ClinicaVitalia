<title>MEDICOS</title>
<?php
require '../includes/funciones.php';
incluirTemplate('header');
      require '../includes/config/database.php';
      $db=conectarDB();
      $idusuario = $_SESSION['idUsuario'];
?>
    <main class="contenedor seccion">
        <h1>Bienvenido <?='$idusuario';?></h1>
        <a href="/clinica/admin/medicos/modifDatos.php"
        class="btn btn-success">Datos</a>
        <a href="/clinica/admin/medicos/MPaciente.php"
        class="btn btn-success" >Listado Pacientes</a>
        <a href="/clinica/admin/medicos/listadoMedico.php"
        class="btn btn-success" >listado medico</a>
        <a href="/clinica/admin/medicos/crear.php"
        class="btn btn-success" >crear medico</a>
        
    </main>

    <!-- DATOS Y LISTA DE PACIENTES -->

    <?php
    incluirTemplate('footer');
?>
