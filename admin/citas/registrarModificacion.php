<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require '../../includes/config/database.php';
        $db=conectarDB();

        
        //SE LIMPIAN LOS DATOS DEL FORMULARIO
        $idCita     =   $_POST['idCita'];
        $tipo       =   $_POST['tipo']; 
        $fecha      =   mysqli_real_escape_string($db, $_POST["fecha"]);
        $hora       =   mysqli_real_escape_string($db, $_POST["hora"]);
        $motivo     =   mysqli_real_escape_string($db, $_POST["motivo"]);
        $idMedico   =   mysqli_real_escape_string($db, $_POST["idMedico"]);

        //SE CREA LA CONSULTA DE INSERCION

        $sql = "UPDATE cita
            SET 
                fecha       =   '$fecha',
                hora        =   '$hora',
                motivo      =   '$motivo', 
                idMedico    =   '$idMedico'
            WHERE 
                idCita      =   '$idCita'";
        
        //SE CONTROLAN LAS EXCEPCIONES 
        try{
            $resultado=mysqli_query($db,$sql);
            if($resultado){
                if ($tipo=='administradores'){
                    ?>
                        <script>
                            alert("SE MODIFICÓ LA CITA");
                            window.location.href = "listado.php"
                        </script>
                    <?php
                }
                else{
                    ?>
                        <script>
                            alert("SE MODIFICÓ LA CITA");
                            window.location.href = "/clinica/admin/indexP.php"
                        </script>
                    <?php
                }
            }
            

        }
        catch(Exception $e){
            if ($tipo=='administradores'){
                ?>
                    <script>
                        alert("HUBO UN ERROR");
                        window.location.href = "listado.php"
                    </script>
                <?php
            }
            else{
                ?>
                    <script>
                        alert("HUBO UN ERROR");
                        window.location.href = "/clinica/admin/indexP.php"
                    </script>
                <?php
            }
        }
    }
?>
