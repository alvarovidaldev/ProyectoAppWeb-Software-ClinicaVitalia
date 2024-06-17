<?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {

        require '../../includes/config/database.php';
        $db=conectarDB();

        //SE LIMPIAN LOS DATOS DEL FORMULARIO

        $idAdministrador =   $_POST['idAdministrador'];
        $tipo       =   $_POST['tipo'];    
        $email      =   mysqli_real_escape_string($db, $_POST["email"]);
        $password   =   mysqli_real_escape_string($db,$_POST["password"]);
    
        //SE HASHEA EL PASSWORD

        $hashedPassword=password_hash($password,PASSWORD_DEFAULT);

        //SE MODIFICAN LOS DATOS

        $sql = "UPDATE administrador
        SET 
            email = '$email',
            pasword = '$hashedPassword'
           
        WHERE idAdministrador = '$idAdministrador';
        ";
       
        //SE CONTROLAN LAS EXCEPCIONES SI SE ENCUENTRAN ERRORES COMO EMAILS DUPLICADOS

        try{
            $resultado=mysqli_query($db,$sql);
        }
        catch(Exception $e){
?>
        <script>
            alert("Hubo un error en el registro.");
        </script>
<?php
        }
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