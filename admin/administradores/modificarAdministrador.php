<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require '../../includes/config/database.php';
        $db=conectarDB();
        
        //SE LIMPIAN LOS DATOS DEL FORMULARIO
        
        $idAdministrador =   $_POST['idAdministrador'];
        $tipo            =   $_POST['tipo'];    
        $aNombre         =   mysqli_real_escape_string($db, $_POST["aNombre"]);
        $aPaterno        =   mysqli_real_escape_string($db, $_POST["aPaterno"]);
        $aMaterno        =   mysqli_real_escape_string($db, $_POST["aMaterno"]);
        $aTelefono       =   mysqli_real_escape_string($db, $_POST["aTelefono"]);
        $aCi             =   mysqli_real_escape_string($db, $_POST["aCi"]);

        //SE MODIFICAN LOS DATOS

        $sql = "UPDATE administrador
        SET 
            aNombre = '$aNombre',
            aPaterno = '$aPaterno',
            aMaterno = '$aMaterno',
            aTelefono = '$aTelefono',
            aCi = '$aCi'
        WHERE idAdministrador = '$idAdministrador';
        ";
        mysqli_query($db,$sql);

        if ($tipo=='administradores'){

            header('Location: listado.php');
            exit();
        }
        else{
            header('Location: /clinica/admin/indexA.php');
            exit();
        }
    }
?>