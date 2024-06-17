<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}
    
    //SE INCLUYE EL HEADER

    include'../../includes/funciones.php';
    incluirTemplate('header');

    //CONEXION A BASE DE DATOS

    require '../../includes/config/database.php';
    $db=conectarDB();


    //RECUPERACIÓN DE DATOS POR TIPO DE ROL

    $tipo       =   $_SESSION['tipo'];
    $idUsuario  =   $_SESSION['idUsuario'];

    $sql        =   "SELECT * FROM atencion WHERE estado = 'Activo' ".($tipo == 'administradores' ? "" : "AND idPaciente = '$idUsuario'");

    $resultado  =   mysqli_query($db,$sql);    

    function recuperarPaciente($id,$db){
        $sql    =   "SELECT * FROM paciente WHERE idPaciente = '$id'";
        $resultado  =   mysqli_query($db,$sql); 
        if($resultado->num_rows>0){
            $paciente= mysqli_fetch_array($resultado);
            return $paciente[1].' '.$paciente[2].' '.$paciente[3];
        }
    }
    function recuperarMedico($id,$db){
        $sql    =   "SELECT * FROM medico WHERE idMedico = '$id'";
        $resultado  =   mysqli_query($db,$sql); 
        if($resultado->num_rows>0){
            $medico= mysqli_fetch_array($resultado);
            return $medico['especialidad'].' - Dr. '.$medico[1].' '.$medico[2].' '.$medico[3];
        }
    }
?>

    <!-- STYLE CSS -->
    <style>
        .listado{
            display: flex; 
            flex-direction: column;
            align-items: center;
            justify-content:center; 
            margin: 50px; 
            text-align: center;
        }

        .btn-custom{
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .acciones{
            display: flex;
            justify-content: space-evenly;
        }

        /* ESTE BLOQUE APLICA ESTILOS PARA EL ANCHO DE LA PANTALLA */

        @media (max-width: 768px) {
        .listado table, .listado th, .listado td, .listado tr {
            display: block;
            border: none;
            width: 100%;
        }

        .listado {
            margin: 50px; 
            align-self: flex-start;
            align-items: center;
            justify-content: center;
        }

         .listado th {
            display: none;
        }

        .listado td {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        } 

        .listado td:before {
            content: attr(data-label);
            font-weight: bold;
            flex-basis: 40%;
            text-align: left;
        }

        .listado tr {
            margin-bottom: 10px;
            border-bottom: 2px solid #f2f2f2;
        } 

        .listado td:last-child {
            border-bottom: none;
        }
    }
    </style>
    
    <div class="listado">
        <h2>ATENCIONES RECIBIDAS</h2>
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/indexP.php" class="btn btn-success">Volver</a>
        <table class="table table-striped table-hover" style="width: 90%;">
            
            <tr>
                <th>Fecha de Atención</th>
                <th>Médico</th>
                <th>Diagnóstico</th>
                <th>Tratamiento</th>
                <th>Costo Pagado</th>
                <th>Imprimir</th>
            </tr>
            

            <?php
                while($atencion = mysqli_fetch_array($resultado)){
            ?>

            <tr>
                <td data-label="Fecha de Atencion:"><?=$atencion[1]?></td>
                <td data-label="Medico:"><?=recuperarMedico($atencion[6],$db)?></td>
                <td data-label="CDiagnostico:"><?=$atencion[2]?></td>
                <td data-label="Tratamiento:"><?=$atencion[3]?></td>
                <td data-label="Costo pagado:"><?=$atencion[4].' Bs.'?></td>
                <td>
                    <a href="atencionPDF.php?idAtencion=<?=$atencion[0]?>" class="btn btn-primary btn-custom" target="_blank">
                    <i class="fa-solid fa-file-pdf fa-xl"></i></a>
                </td>
            </tr>
            <?php } ?>
        </table>

    </div>
    
<?php
    incluirTemplate('footer');
?>