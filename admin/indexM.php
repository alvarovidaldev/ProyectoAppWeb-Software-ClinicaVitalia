<title>MEDICO</title>
<?php 

    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start(); }
    $auth=$_SESSION['login']?? false;        
    if (!$auth){header('Location: /clinica/index.php');}

    //CONEXION A BASE DE DATOS
    
    require '../includes/config/database.php';
    $db=conectarDB();

    //RECUPERACICIÓN DE DATOS DE USUARIO
    
    $idMedico = $_SESSION['idUsuario'];

    $sql= "SELECT * FROM medico WHERE idMedico='$idMedico'";
    $resultado=mysqli_query($db,$sql);
    if($resultado->num_rows>0){
        $medico=mysqli_fetch_array($resultado);
    }

    require '../includes/funciones.php';
    incluirTemplate('header');
?>
<style>
    .paciente{
        display: flex;
        flex-direction: column;
        text-align: center;
        margin:50px;
    }
    .opciones{
        display: flex;
        justify-content:space-evenly;
        
        margin: 50px;

    }
    .opcionPaciente{
        width:20%;

        padding: 20px;
        border: 2px solid var(--color-verde-azul);
        border-radius:50px;
        background-color: var(--color-blancomedico);
        color: var(--color-verde-oscuro);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        font-style: italic;

        /* NUEVOS CAMPOS */
        margin: 10px; /* Add margin for better spacing */
        box-sizing: border-box;

    }
    .opcionPaciente a{
        width: 70%;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    /* Media Queries */
    @media (max-width: 1200px) {
        .opcionPaciente {
            width: 30%; /* Adjust width for larger screens */
        }
    }
    @media (max-width: 992px) {
        .opcionPaciente {
            width: 45%; /* Adjust width for tablets */
        }
    }
    @media (max-width: 768px) {
        .opcionPaciente {
            width: 100%; /* Full width for smaller devices */
        }
        .opciones {
            flex-direction: column;
            align-items: center;
        }
    }
    

</style>
<div class="paciente">
    <h2><i>Bienvenido <?=$medico['1'].' '.$medico['2'].' '.$medico['3']?></i></h2>
    <div class="opciones">
        <div class="opcionPaciente">
        <br><i class="fa-solid fa-user-pen fa-2xl"></i>
        <br><p>En esta sección, puedes actualizar y modificar tu información personal, incluyendo tu nombre, apellido, dirección, número de teléfono y cualquier otra información relevante.</p><br>
        <a href="medicos/modificarMedico.php?cod=<?=$medico[0]?>" class="btn btn-success">MODIFICAR DATOS</a>

        </div>  

        <div class="opcionPaciente">
        <br><i class="fa-regular fa-id-card fa-2xl"></i>
        <br><p>En esta sección, puedes visualizar el listado de pacientes que esperan ser atendidos por usted, incluyendo la opcion de hacer la consulta inmediata, y un informe correspondiente del paciente.</p><br>
        <a href="medicos/ListaPaciente.php?idMedico=<?=$medico[0]?>" class="btn btn-success">MIS PACIENTES</a>
        </div>

    </div>
  
</div>


<?php
    incluirTemplate('footer');
?>

