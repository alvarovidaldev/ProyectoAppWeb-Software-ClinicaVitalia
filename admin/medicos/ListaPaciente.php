<title>LISTA-PACIENTE</title>
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

    $idMedico=$_SESSION['idUsuario'];
    
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

        table{
            text-align: center;
        }

        
        .acciones{
            display: flex;
            justify-content: space-evenly;
        }

        @media (max-width: 768px) {
        .listado table, .listado th, .listado td, .listado tr {
            display: block;
            border: none;
            width: 115%; /*esto controla la anchura*/ 
        }

        .listado {
            margin: 20px; 
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
        <h2> LISTADO DE PACIENTES </h2>
        <a style="margin: 20px; align-self: flex-start;" href="/clinica/admin/indexM.php" class="btn btn-success">Volver</a>
        <table class="table table-striped table-hover" style="width: 90%;">
            <thead>
                <th> Nombre </th>
                <th> Paterno </th>
                <th> Materno </th>
                <th> Motivo </th>
                <th> Fecha </th>
                <th> Hora </th>
                <th> Estado </th>
                <th> Acciones </th>
            </thead>

            <tbody>
                <?php
                    $con_sql="SELECT p.*,c.* FROM paciente p JOIN cita c ON p.idPaciente=c.idPaciente WHERE c.idMedico='$idMedico'";
                    $res=mysqli_query($db,$con_sql);
                        while($reg=$res->fetch_assoc())     //$reg=$res->fetch_assoc()  //$var=mysqli_fetch_array($res)
                        { 
                            $idCita = $reg['idCita'];         
                ?>
                <tr>
                    <td data-label="Paterno:"> <?php echo $reg['pNombre']; ?> </td>
                    <td data-label="Materno:"> <?php echo $reg['pPaterno']; ?> </td>
                    <td data-label="Nombre:"> <?php echo $reg['pMaterno']; ?> </td>
                    <td data-label="Motivo:"> <?php echo $reg['motivo']; ?> </td>
                    <td data-label="Fecha:"> <?php echo $reg['fecha']; ?> </td>
                    <td data-label="Hora:"> <?php echo $reg['hora']; ?> </td>
                    <td data-label="Estado:"> <?php echo $reg['estado']; ?> </td>
                    <?php
                        $sql="SELECT * FROM atencion WHERE idCita='$idCita'";
                        $resultado=mysqli_query($db,$sql);
                        if($resultado->num_rows==0){
                            
                    ?>  
                            <td><a class="btn btn-success" href="atencionPaciente.php?cod=<?php echo $reg['idPaciente'];?>">Revisión</a></td>
                    <?php
                        }
                        else{
                            $atencion=mysqli_fetch_array($resultado);
                            
                    ?>  
                    <td>
                        <div class="acciones">  
                            <a class="btn btn-primary " href="info.php?cod=<?php echo $reg['idPaciente'] ;?>&atencion=<?=$atencion[0]?>">Informe</a>   
                            <a class="btn btn-warning " href="../atenciones/modificar.php?idAtencion=<?=$atencion[0]?>">Modificación</a>
                        </div> 
                    </td>
                    <?php
                        }             
                    ?>                 




                    
                    <?php 
                        } 
                    ?> 
                </tr>
            </tbody>
        </table>
    </div>

    <?php
    incluirTemplate ('footer');
?>