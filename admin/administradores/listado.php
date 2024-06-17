<title>ADMINISTRADORES</title>
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

    //RECUPERACIÓN DE DATOS
    $sql        =   "SELECT * FROM administrador WHERE estado = 'Activo' ORDER BY aPaterno, aMaterno, aNombre";
    $resultado  =   mysqli_query($db,$sql); 

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

        .listado th{
            text-align: center;
        }


        .listado td{
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

        @media (max-width: 768px) {
        .listado table, .listado th, .listado td, .listado tr {
            display: block;
            border: none;
            width: 135%;
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
        <!-- <div class="container"> -->
        <h2>LISTADO DE ADMINISTRADORES</h2>
        <!-- </div> -->
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/indexA.php" class="btn btn-success">Volver</a>
        <table class="table table-striped table-hover" style="width: 90%;">

            <tr>
                <!-- <th>idAdministrador</th> -->
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Cedula</th>
                <th>Email</th>
                <th colspan="2"">Acciones</th>
            </tr>

            <?php
                while($administrador = mysqli_fetch_array($resultado)){
            ?>


            <tr>
                <td data-label="Apellido Paterno:"><?=$administrador[2]?></td>
                <td data-label="Apellido Materno:"><?=$administrador[3]?></td>
                <td data-label="Nombre:"><?=$administrador[1]?></td>
                <td data-label="Telefono:"><?=$administrador[4]?></td>
                <td data-label="Cedula:"><?=$administrador[5]?></td>
                <td data-label="Email:"><?=$administrador[6]?></td>
                <td class="acciones"> 
                    <a href="https://wa.me/591<?=$administrador[4]?>" target="_blank" class="btn btn-success btn-custom">
                    <i class="fa-brands fa-whatsapp fa-xl"></i></a>

                    <a href="modificar.php?idAdministrador=<?=$administrador[0]?>" class="btn btn-warning btn-custom">
                    <i class="fa-solid fa-pencil fa-xl"></i></a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-custom" data-bs-toggle="modal" data-bs-target="#borrar<?=$administrador[0]?>">
                    <i class="fa-solid fa-trash-can fa-xl"></i>
                    </button>
                </td>

                <!-- Modal -->
                <div class="modal fade" id="borrar<?=$administrador[0]?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Administrador</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            SE ELIMINARA A <?=strtoupper($administrador[2].' '.$administrador[3].' '.$administrador[1]);?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="borrar.php?idAdministrador=<?=$administrador[0]?>" class="btn btn-danger">Borrar</a>
                        </div>
                        </div>
                    </div>
                </div>

            </tr>
            <?php } ?>
        </table>
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/administradores/crear.php" class="btn btn-success">Nuevo Administrador</a>
    </div>
    
<?php
    incluirTemplate('footer');
?>    