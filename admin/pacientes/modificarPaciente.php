<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require '../../includes/config/database.php';
        $db=conectarDB();
        
        //SE LIMPIAN LOS DATOS DEL FORMULARIO
        
        $idPaciente =   $_POST['idPaciente'];
        $tipo       =   $_POST['tipo'];    
        $pNombre    =   mysqli_real_escape_string($db, $_POST["pNombre"]);
        $pPaterno   =   mysqli_real_escape_string($db, $_POST["pPaterno"]);
        $pMaterno   =   mysqli_real_escape_string($db, $_POST["pMaterno"]);
        $pTelefono  =   mysqli_real_escape_string($db, $_POST["pTelefono"]);
        $pFechaN    =   mysqli_real_escape_string($db, $_POST["pFechaN"]);
        $pCi        =   mysqli_real_escape_string($db, $_POST["pCi"]);

        //SE MODIFICAN LOS DATOS

        $sql = "UPDATE paciente
        SET 
            pNombre = '$pNombre',
            pPaterno = '$pPaterno',
            pMaterno = '$pMaterno',
            pTelefono = '$pTelefono',
            pFechaN = '$pFechaN',
            pCi = '$pCi'
        WHERE idPaciente = '$idPaciente';
        ";
        mysqli_query($db,$sql);

        if ($tipo=='administradores'){

            header('Location: listado.php');
            exit();
        }
        else{
            header('Location: /clinica/admin/indexP.php');
            exit();
        }
    }
?>