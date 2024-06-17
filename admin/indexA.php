<title>ADMINISTRADOR</title>
<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start(); }
    $auth=$_SESSION['login']?? false;       

    if (!$auth){header('Location: /clinica/index.php');}
    
    require '../includes/funciones.php';
    incluirTemplate('header');

    //CONEXION A BASE DE DATOS

    require '../includes/config/database.php';
    $db=conectarDB();

    //RECUPERACICIÓN DE DATOS DE USUARIO
    $idAdministrador=$_SESSION['idUsuario'];
    $sql= "SELECT * FROM administrador WHERE idAdministrador='$idAdministrador'";
    $resultado=mysqli_query($db,$sql);
    if($resultado->num_rows>0){
        $administrador=mysqli_fetch_array($resultado);
    }
   
?>

<style>
    .tarjeta{
        width: 15rem; display: inline-block; margin: 10px; border-radius: 200px;
    }
</style>

<h2 style="text-align: center; margin: 20px;"><i>Bienvenido <?=$administrador['1'].' '.$administrador['2'].' '.$administrador['3']?></i></h2>
<main class="contenedor seccion">

        <!-- TITULO DEL ADMINISTRADOR -->
        <center>
            <br><br>
            <h1><strong>ADMINISTRADOR DE CLINICA VITALIA</strong></h1>
            <br><br>
           

            <!-- BOTON DE ADMINISTRADOR -->
            <div class="card tarjeta" >
                <img src="administradores/logos/admi.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="/clinica/admin/administradores/listado.php" class="btn btn-warning">ADMINISTRADOR</a>
                </div>
            </div>

            <!-- BOTON DE MEDICOS -->
            <div class="card tarjeta" >
                <img src="administradores/logos/medico.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="/clinica/admin/medicos/listadoMedico.php" class="btn btn-info">MEDICOS</a>
                </div>
            </div>


             <!-- BOTON DE PACIENTES -->
            <div class="card tarjeta">
                <img src="administradores/logos/paciente.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="/clinica/admin/pacientes/listado.php" class="btn btn-success">PACIENTES</a>
                </div>
            </div>


            <!-- BOTON DE CITAS -->
            <div class="card tarjeta" >
                <img src="administradores/logos/cita.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="/clinica/admin/citas/listado.php" class="btn btn-primary">CITAS</a>
                </div>
            </div>

            <!-- BOTON DE ATENCIONES -->
            <div class="card tarjeta" >
                <img src="administradores/logos/examen.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <a href="/clinica/admin/atenciones/listado.php" class="btn btn-secondary">ATENCIONES</a>
                </div>
            </div>
            <br><br>
        </center>
    </main>

<?php
    incluirTemplate('footer');
?>    