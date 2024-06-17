<title>AGENDAR ATENCION - VITALIA</title>
<?php    
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    require '../../includes/config/database.php';
    $db=conectarDB();

    //OBTENER DATOS DE LOS MÉDICOS

    $sql        ="SELECT * FROM medico";
    $medicos    = mysqli_query($db,$sql);

    //OBTENER DATOS DE LA ATENCION MÉDICA

    $idAtencion =   $_GET['idAtencion'];
    $sql        =   "SELECT * FROM atencion WHERE idAtencion='$idAtencion'";
    $resultado  =   mysqli_query($db,$sql);

    if($resultado->num_rows>0){
        $atencion       =   mysqli_fetch_array($resultado);
        $fecha          =   $atencion['fechaAtencion'];
        $diagnostico    =   $atencion['diagnostico'];
        $tratamiento    =   $atencion['tratamiento'];
        $costo          =   $atencion['costoAtencion'];
        $idPaciente     =   $atencion['idPaciente'];
        $idMedico       =   $atencion['idMedico'];
    }

    //SE INCLUYE EL HEADER

    include'../../includes/funciones.php';
    incluirTemplate('header');

?>
<!-- FORMULARIO DE REGISTRO -->
<style>
        .formulario{
        margin-bottom: 20px;
        padding:20px;
        background-color: #F2F8F4; 
        color:var(--color-verde-oscuro); 
        font-weight:bold;
        border: 2px solid var(--color-verde-azul);
        border-radius: 20px;
    }
</style>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a style="margin: 20px;" href="/clinica/admin/medicos/listaPaciente.php" class="btn btn-success">Volver</a>
            <div class="formulario">
                <h2 class="mb-4">Modificar Atencion</h2>
                <form action="registrarModificacion.php" method="post">
                    <input type="hidden" name="idAtencion" value="<?=$idAtencion?>">
                    <input type="hidden" name="tipo" value="<?=$_SESSION['tipo']?>">
                    <div class="row">
                        <div class="form-group">
                            <label for="tratamiento">Tratamiento</label>
                            <textarea class="form-control" id="tratamiento" name="tratamiento" rows="5" required><?=$tratamiento?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="diagnostico">Diagnostico</label>
                            <textarea class="form-control" id="diagnostico" name="diagnostico" rows="5" required><?=$diagnostico?></textarea>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success offset-md-5">Modificar Atencion</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
    incluirTemplate('footer');
?>