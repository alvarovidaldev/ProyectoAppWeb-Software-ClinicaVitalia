<title>INFO</title>
<?php
    require '../../includes/config/database.php';
    $db=conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');
    $idusuario = $_SESSION['idUsuario'];
    $cod=$_GET['cod'];
    $atencion=$_GET['atencion'];
?>

    <style>
        .listado{
            display: flex; 
            flex-direction: column;
            align-items: center;
            justify-content:center; 
            margin: 50px; 
            text-align: center;

        }

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
        $consulta="SELECT p.*,a.* FROM paciente p INNER JOIN atencion a ON p.idPaciente=a.idPaciente and a.idPaciente='$cod'";
        $res=mysqli_query($db,$consulta);
        if($res->num_rows>0){
            $fila=mysqli_fetch_array($res);
        }        

    ?>
    <div class="listado">
        <h2>INFORME DEL PACIENTE</h2>
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/medicos/ListaPaciente.php" class="btn btn-success">Volver</a>
        <div class="formulario"> 
        <form action="info.php?cod=<?php echo $fila['idPaciente']; ?>" method="post">
            <table class="table" >
                <tr>
                    <td>Nombre</td>
                    <td><?php echo $fila['pNombre']; ?></td>
                </tr>

                <tr>
                    <td>Paterno</td>
                    <td><?php echo $fila['pPaterno']; ?></td>
                </tr>

                <tr>
                    <td>Materno</td>
                    <td><?php echo $fila['pMaterno']; ?></td>
                </tr>

                <tr>
                    <td>Diagnostico</td>
                    <td><?php echo $fila['diagnostico']; ?></td>
                </tr>
                <tr>
                    <td>Tratamiento</td>
                    <td><?php echo $fila['tratamiento']; ?></td>
                </tr>
                <tr>
                    <td>Costo de la Consulta</td>
                    <td><?php echo $fila['costoAtencion']; ?></td>
                </tr>


            </table>
            <br>
            <a href="../pacientes/atencionPDF.php?idAtencion=<?=$atencion?>" target="_blank">
            <i class="fa-solid fa-file-pdf fa-xl"></i></a>
        </form>
        </div>
    </div>
     
<?php
    incluirTemplate ('footer');
?>