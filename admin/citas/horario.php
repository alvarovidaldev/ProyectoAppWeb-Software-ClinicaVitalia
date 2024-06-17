<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require '../../includes/config/database.php';
        $db = conectarDB();
        
        $horario = array('09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00');
        $horarioNoDisponible = array();
            
        $fecha = mysqli_real_escape_string($db, $_POST['fecha']);
        $sql = "SELECT * FROM cita WHERE fecha = '$fecha'";
        $resultado = mysqli_query($db, $sql);

        while($hora = mysqli_fetch_array($resultado)){
            $horarioNoDisponible[] = date('H:i', strtotime($hora['hora']));
        }
        $horarioDisponible = array_diff($horario, $horarioNoDisponible);
        
        echo json_encode(array_values($horarioDisponible));
    }
?>
