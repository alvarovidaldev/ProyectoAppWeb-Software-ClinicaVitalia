<title>PACIENTE</title>
<?php 

    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start(); }
    $auth=$_SESSION['login']?? false;        
    if (!$auth){header('Location: /clinica/index.php');}

    //CONEXION A BASE DE DATOS

    require '../includes/config/database.php';
    $db=conectarDB();

    //RECUPERACICIÓN DE DATOS DE USUARIO
    $idPaciente=$_SESSION['idUsuario'];
    $sql= "SELECT * FROM paciente WHERE idPaciente='$idPaciente'";
    $resultado=mysqli_query($db,$sql);
    if($resultado->num_rows>0){
        $paciente=mysqli_fetch_array($resultado);
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
    <h2><i>Bienvenido <?=$paciente['1'].' '.$paciente['2'].' '.$paciente['3']?></i></h2>
    <div class="opciones">
        <div class="opcionPaciente">
            <br><i class="fa-solid fa-user-pen fa-2xl"></i><br>
            <br><p>En esta sección, puedes actualizar y modificar tu información personal, incluyendo tu nombre, apellido, dirección, número de teléfono y cualquier otra información relevante. Mantener tus datos actualizados es fundamental para garantizar una comunicación efectiva y recibir la mejor atención médica posible.</p><br>
            <a href="pacientes/modificar.php?idPaciente=<?=$paciente[0]?>" class="btn btn-success">MODIFICAR DATOS</a>
        </div>  

        <div class="opcionPaciente">
            <br><i class="fa-solid fa-truck-medical fa-2xl"></i><br>
            <br><p>Agendar una cita médica nunca ha sido tan fácil. Aquí, puedes seleccionar la fecha y hora que mejor se adapte a tu agenda para programar tu próxima consulta médica. Simplemente elige el especialista y el horario disponible que prefieras, y estaremos encantados de atenderte.</p><br>
            <a href="citas/crear.php" class="btn btn-success">AGENDAR CITA MÉDICA</a>
        </div>
        
        <div class="opcionPaciente">
            <br><i class="fa-solid fa-book-medical fa-2xl"></i><br>
            <br><p>En esta sección, encontrarás un registro completo de todas tus citas médicas pasadas y futuras. Mantente al tanto de tus próximas consultas y revisa el historial de citas anteriores para un seguimiento detallado de tu atención médica. ¡Tu salud es nuestra prioridad!</p><br>
            <a href="citas/listado.php" class="btn btn-success">MIS CITAS</a>
        </div> 

        <div class="opcionPaciente">
            <br><i class="fa-solid fa-file-waveform fa-2xl"></i><br>
            <br><p>Aquí, puedes acceder a un resumen de todas las atenciones médicas que has recibido. Desde exámenes de rutina hasta tratamientos especializados, esta sección te brinda una visión general de tu historial médico. Mantén un seguimiento de tus procedimientos y garantiza un cuidado integral de tu salud.</p><br>
            <a href="pacientes/atencionesRecibidas.php" class="btn btn-success">MIS ATENCIONES</a>
        </div> 

    </div>
  
</div>


<?php
    incluirTemplate('footer');
?>
