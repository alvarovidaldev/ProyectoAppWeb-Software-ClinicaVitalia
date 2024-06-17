<title>ATENCIONES-VITALIA</title>
<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    include'../../includes/funciones.php';
    incluirTemplate('header');

    require '../../includes/config/database.php';
    $db=conectarDB();


    $tipo=$_SESSION['tipo'];
    $idUsuario=$_SESSION['idUsuario'];

    $sql= "SELECT * FROM atencion WHERE estado = 'Activo' ".($tipo == 'administradores' ? "" : "AND idPaciente = '$idUsuario'")."ORDER BY fechaAtencion desc";

    $resultado= mysqli_query($db,$sql);    

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
            align-items: center;
            width: 100px;
            justify-content: space-evenly; 
        }

        /* ESTE BLOQUE APLICA ESTILOS PARA EL ANCHO DE LA PANTALLA */

        @media (max-width: 768px) {
        .listado table, .listado th, .listado td, .listado tr {
            display: block;
            border: none;
            width: 105%;
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
        <h2>ATENCIONES</h2>
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/index<?=($tipo == 'administradores' ?'A':'P')?>.php" class="btn btn-success">Volver</a>
        <table class="table table-striped table-hover" style="width: 90%;">
            
            <tr>
                <th>Paciente</th>
                <th>Médico</th>
                <th>FechaAtencion</th>
                <th>Diagnostico</th>
                <th>Tratamiento</th>
                <th>Costo</th>         
                <th colspan="2">Acciones</th>
            </tr>
            

            <?php
                while($atencion = mysqli_fetch_array($resultado)){
            ?>

            <tr>
                <td data-label="Paciente:"><?=recuperarPaciente($atencion[5],$db)?></td>
                <td data-label="Medico:"><?=recuperarMedico($atencion[6],$db)?></td>
                <td data-label="FechaArencion:"><?=$atencion[1]?></td>
                <td data-label="Diagnostico:"><?=$atencion[2]?></td>
                <td data-label="Tratamiento:"><?=$atencion[3]?></td>
                <td data-label="Costo:"><?=$atencion[4]?></td>


                <td>
                    <div class="acciones">
                        <a href="modificar.php?idAtencion=<?=$atencion[0]?>" class="btn btn-warning btn-custom">
                        <i class="fa-solid fa-pencil fa-xl"></i></a>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-custom" data-bs-toggle="modal" data-bs-target="#borrarAtencion=<?=$atencion[0]?>">
                            <i class="fa-solid fa-trash-can fa-xl"></i>
                        </button>
                    </div>
                </td>

                <!-- Modal -->
                <div class="modal fade" id="borrarAtencion=<?=$atencion[0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Atención</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            SE ELIMINARA LA ATENCIÓN
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="borrar.php?idAtencion=<?=$atencion[0]?>" class="btn btn-danger">Borrar</a>
                        </div>
                        </div>
                    </div>
                </div>
            </tr>
            <?php } ?>
        </table>

    </div>
    
<?php
    incluirTemplate('footer');
?>