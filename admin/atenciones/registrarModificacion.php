<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require '../../includes/config/database.php';
        $db=conectarDB();

        
        //SE LIMPIAN LOS DATOS DEL FORMULARIO
        $idAtencion    =   $_POST['idAtencion'];
        $tipo          =   $_POST['tipo']; 
        // $fecha         =   mysqli_real_escape_string($db, $_POST["fechaAtencion"]);
        $diagnostico   =   mysqli_real_escape_string($db, $_POST["diagnostico"]);
        $tratamiento   =   mysqli_real_escape_string($db, $_POST["tratamiento"]);
        // $costo         =   mysqli_real_escape_string($db, $_POST["costo"]);
        // $idMedico      =   mysqli_real_escape_string($db, $_POST["idMedico"]);

        //SE CREA LA CONSULTA DE INSERCION

        $sql = "UPDATE atencion
            SET 
                diagnostico =   '$diagnostico',
                tratamiento =   '$tratamiento'
            WHERE 
                idAtencion     =   '$idAtencion'";
        
        //SE CONTROLAN LAS EXCEPCIONES 
        try{
            $resultado=mysqli_query($db,$sql);
            if($resultado){
                if ($tipo=='administradores'){
                    ?>
                        <script>
                            alert("SE MODIFICÓ LA ATENCION");
                            window.location.href = "listado.php"
                        </script>
                    <?php
                }
                else{
                    ?>
                        <script>
                            alert("SE MODIFICÓ LA ATENCION");
                            window.location.href = "/clinica/admin/medicos/ListaPaciente.php"
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
                        window.location.href = "/clinica/admin/medicos/ListaPaciente.php"
                    </script>
                <?php
            }
        }
    }
?>
