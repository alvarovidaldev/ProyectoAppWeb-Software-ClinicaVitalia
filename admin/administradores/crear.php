<title>CREAR</title>
<?php    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require '../../includes/config/database.php';
        $db=conectarDB();
        
        //SE LIMPIAN LOS DATOS DEL FORMULARIO

        $aNombre    =   mysqli_real_escape_string($db, $_POST["aNombre"]);
        $aPaterno   =   mysqli_real_escape_string($db, $_POST["aPaterno"]);
        $aMaterno   =   mysqli_real_escape_string($db, $_POST["aMaterno"]);
        $aTelefono  =   mysqli_real_escape_string($db, $_POST["aTelefono"]);
        $aCi        =   mysqli_real_escape_string($db, $_POST["aCi"]);
        $email      =   mysqli_real_escape_string($db, $_POST["email"]);
        $password   =   mysqli_real_escape_string($db, $_POST["password"]);

        //SE HASHEA EL PASSWORD

        $hashedPassword=password_hash($password,PASSWORD_DEFAULT);

        //SE CREA LA CONSULTA DE INSERCION

        $sql = "INSERT INTO administrador ( aNombre, aPaterno, aMaterno, aTelefono, aCi, email, pasword) 
        VALUES ('$aNombre', '$aPaterno', '$aMaterno', '$aTelefono', '$aCi', '$email', '$hashedPassword')";
        
        //SE CONTROLAN LAS EXCEPCIONES SI SE ENCUENTRAN ERRORES COMO EMAILS DUPLICADOS

        try{
            $resultado=mysqli_query($db,$sql); 
            if($resultado){
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['idUsuario']=mysqli_insert_id($db);
                header('Location: ../indexA.php');
                exit();
            }
        }
        catch(Exception $e){
    ?>
            <script>
                alert("Hubo un error en el registro.");
                window.location.href = "/clinica/index.php"
            </script>
    <?php  
        }
    }

    //SE INCLUYE EL HEADER

    include'../../includes/funciones.php';
    incluirTemplate('header');

?>

<!-- FORMULARIO DE REGISTRO -->
<style>
        .formulario{
        margin-bottom: 20px;
        padding:20px;
        background-color: #F2F8F4; 
        color:var(--color-verde-oscuro); 
        font-weight:bold;
        border: 2px solid var(--color-verde-azul);
        border-radius: 20px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <a style="margin: 20px;" href="/clinica/admin/administradores/listado.php" class="btn btn-success">Volver</a>
            <div class="formulario">
                <h2 class="mb-4">Registro de Administrador</h2>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aNombre">Nombre:</label>
                                <input type="text" class="form-control" id="aNombre" name="aNombre" required>
                            </div>
                            <div class="form-group">
                                <label for="aPaterno">Apellido Paterno:</label>
                                <input type="text" class="form-control" id="aPaterno" name="aPaterno">
                            </div>
                            <div class="form-group">
                                <label for="aMaterno">Apellido Materno:</label>
                                <input type="text" class="form-control" id="aMaterno" name="aMaterno">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aTelefono">Teléfono:</label>
                                <input type="tel" class="form-control" id="aTelefono" name="aTelefono" required>
                            </div>
                            <div class="form-group">
                                <label for="aCi">Cedula:</label>
                                <input type="text" class="form-control" id="aCi" name="aCi" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success offset-md-5">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    incluirTemplate('footer');
?>    
