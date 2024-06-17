<title>ListaPA</title>
<?php
    require '../../includes/config/database.php';
    $db=conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');
    $idusuario = $_SESSION['idUsuario'];
    $cod=$_GET['cod'];
    if($_POST)
    {
        $var=$_POST['dia'];

        $var1=$_POST['trat'];
        $var2=$_POST['cos'];
        $idCita = $_POST['idCita'];
        $fechaAtencion=$_POST['fecha'];

        $con_sql = "INSERT INTO atencion (fechaAtencion,diagnostico, tratamiento, costoAtencion, idPaciente,idMedico,idCita) VALUES ('$fechaAtencion','$var', '$var1', '$var2', '$cod','$idusuario',$idCita)";

        $resm=mysqli_query($db,$con_sql);

        if($resm){
            echo  " ?>
            <script> 
                    window.alert('Se Registro con exito');
                    window.location='ListaPaciente.php';
            </script>
                ";
        } 
    }
?>

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

    <?php 
        $sql="SELECT p.*,c.* FROM paciente p JOIN cita c ON p.idPaciente=c.idPaciente WHERE c.idPaciente='$cod'";
        $resultado=mysqli_query($db,$sql);
        if($resultado->num_rows>0){
            $cita=mysqli_fetch_array($resultado);
        }
    ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/medicos/ListaPaciente.php" class="btn btn-success">Volver</a>
        <div class="formulario">

            <h2 class="mb-4">REGISTRAR CONSULTA</h2>
            <form action="" method="post">
                <input type="hidden" name="idCita" value="<?=$cita['idCita']?>" >
                <input type="hidden" name="fecha" value="<?=$cita['fecha']?>" >
            <div class="row">
                <div class="col-md-12">

                    <div class="form-group">
                        <td>Nombre</td>
                        <td><input type="text" class="form-control" name="nom" id="nom" value="<?php echo $cita['pNombre']; ?>"></td>
                    </div>

                    <div class="form-group">
                        <td>Paterno</td>
                        <td><input type="text" class="form-control" name="pat" id="pat" value="<?php echo $cita['pPaterno']; ?>"></td>
                    </div>

                    <div class="form-group">
                        <td>Materno</td>
                        <td><input type="text" class="form-control" name="mat" id="mat" value="<?php echo $cita['pMaterno']; ?>"></td>
                    </div>

                    <div class="form-group">
                        <td>Diagnostico</td>
                        <td><input type="text"  name="dia" id="dia" class="form-control"></td>
                    </div>

                    <div class="form-group">
                        <td>Tratamiento</td>
                        <textarea name="trat" id="trat" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <td>Costo de la Consulta</td>
                        <td><input type="text" class="form-control" name="cos" id="cos"></td>
                    </div>
                    <br>
                    <button type="submit" name="Modificar" id="Modificar" value="Modificar" class="btn btn-success offset-md-5">Registrar</button>      

                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
</div>

      
<?php
    incluirTemplate ('footer');
?>