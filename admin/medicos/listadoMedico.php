<title>MEDICOS</title>
<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    //SE INCLUYE EL HEADER

    require '../../includes/funciones.php';
    incluirTemplate('header');

    //CONEXION A BASE DE DATOS

    require '../../includes/config/database.php';
    $db=conectarDB();
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
            height: 116.8px;
            align-items: center;
            justify-content: space-evenly;
        }

        @media (max-width: 768px) {
        .listado table, .listado th, .listado td, .listado tr {
            display: block;
            border: none;
            width: 130%;
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
        <h2> LISTADO DE MEDICOS </h2>
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/indexA.php" class="btn btn-success">Volver</a>
        <table class="table table-striped table-hover" style="width: 90%;">

            <thead>
                <th> Id </th>
                <th> Nombre </th>
                <th> Paterno </th>
                <th> Materno </th>
                <th> Imagen </th>
                <th> Especialidad </th>
                <th> NroCI </th>
                <th> Telefono </th>
                <th> Email </th>
                <th colspan="2"> Acciones </th>
            </thead>

            <tbody>
                <?php
                    $idusuario = $_SESSION['idUsuario'];

                    $con_sql="SELECT * FROM medico WHERE estado='Activo'" ;
                    $res=mysqli_query($db,$con_sql);
                    while($reg=$res->fetch_assoc())     //$reg=$res->fetch_assoc()  //$var=mysqli_fetch_array($res)
                    {
                ?>
                <tr>
                    <td data-label="Id:"> <?php echo $reg['idMedico']; ?> </td>
                    <td data-label="Nombre:"> <?php echo $reg['mNombre']; ?> </td>
                    <td data-label="Apellido Paterno:"> <?php echo $reg['mPaterno']; ?> </td>
                    <td data-label="Apellido Materno:"> <?php echo $reg['mMaterno']; ?> </td>
                    <td data-label="Imagen:"> <img src="imagenes/<?php echo $reg['imagen']?>" width="100" height="100"> </td>
                    <td data-label="Especialidad:"> <?php echo $reg['especialidad']; ?> </td>
                    <td data-label="Cedula:"> <?php echo $reg['mCi']; ?> </td>
                    <td data-label="Telefono:"> <?php echo $reg['mTelefono']; ?> </td>
                    <td data-label="Email:"> <?php echo $reg['email']; ?> </td>


                <td class="acciones">
                    <a href="https://wa.me/591<?=$reg['mTelefono']?>" target="_blank" class="btn btn-success btn-custom">
                    <i class="fa-brands fa-whatsapp fa-xl"></i></a>
                    
                    <a  href="modificarMedico.php? cod=<?php echo $reg['idMedico'];?>" class="btn btn-warning btn-custom">
                    <i class="fa-solid fa-pencil fa-xl"></i></a>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-custom" data-bs-toggle="modal" data-bs-target="#borrar<?=$reg['idMedico']?>">
                        <i class="fa-solid fa-trash-can fa-xl"></i>
                    </button>
                </td>

                <!-- Modal -->
                <div class="modal fade" id="borrar<?=$reg['idMedico']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Medico</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            SE ELIMINARA A <?=strtoupper($reg['mPaterno'].' '.$reg['mMaterno'].' '.$reg['mNombre']);?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a href="eliminarMedico.php? cod=<?php echo $reg['idMedico'];?>" class="btn btn-danger">Borrar</a>
                        </div>
                        </div>
                    </div>
                </div>


                    
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/medicos/crear.php" class="btn btn-success">Nuevo Medico</a>
    </div>       
        

    <?php
    incluirTemplate ('footer');
?>