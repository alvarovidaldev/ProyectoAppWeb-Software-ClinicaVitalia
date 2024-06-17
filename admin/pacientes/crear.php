<title>REGISTRO DE CITA - VITALIA</title>
<?php    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require '../../includes/config/database.php';
        $db=conectarDB();
        
        //SE LIMPIAN LOS DATOS DEL FORMULARIO

        $pNombre    =   mysqli_real_escape_string($db, $_POST["pNombre"]);
        $pPaterno   =   mysqli_real_escape_string($db, $_POST["pPaterno"]);
        $pMaterno   =   mysqli_real_escape_string($db, $_POST["pMaterno"]);
        $pTelefono  =   mysqli_real_escape_string($db, $_POST["pTelefono"]);
        $pFechaN    =   mysqli_real_escape_string($db, $_POST["pFechaN"]);
        $pCi        =   mysqli_real_escape_string($db, $_POST["pCi"]);
        $email      =   mysqli_real_escape_string($db, $_POST["email"]);
        $password   =   mysqli_real_escape_string($db, $_POST["password"]);

        //SE HASHEA EL PASSWORD

        $hashedPassword=password_hash($password,PASSWORD_DEFAULT);

        //SE CREA LA CONSULTA DE INSERCION

        $sql = "INSERT INTO paciente ( pNombre, pPaterno, pMaterno, pTelefono, pFechaN, pCi, email, pasword) 
        VALUES ('$pNombre', '$pPaterno', '$pMaterno', '$pTelefono', '$pFechaN', '$pCi', '$email', '$hashedPassword')";
        
        //SE CONTROLAN LAS EXCEPCIONES SI SE ENCUENTRAN ERRORES COMO EMAILS DUPLICADOS

        try{
            $resultado=mysqli_query($db,$sql); 
            if($resultado){
                // session_start();
                // $_SESSION['login'] = true;
                // $_SESSION['idUsuario']=mysqli_insert_id($db);
                ?>
                <script>
                    alert("Se registro exitosamente.");
                    window.location.href = "/clinica/login.php"
                </script> 
                <?php
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
        <a style="margin: 20px;" href="/clinica/login.php" class="btn btn-success">Volver</a>
            <div class="formulario">
                <h2 class="mb-4">Registro de Paciente</h2>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pNombre">Nombre:</label>
                                <input type="text" class="form-control" id="pNombre" name="pNombre" required>
                            </div>
                            <div class="form-group">
                                <label for="pPaterno">Apellido Paterno:</label>
                                <input type="text" class="form-control" id="pPaterno" name="pPaterno">
                            </div>
                            <div class="form-group">
                                <label for="pMaterno">Apellido Materno:</label>
                                <input type="text" class="form-control" id="pMaterno" name="pMaterno">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pTelefono">Teléfono:</label>
                                <input type="tel" class="form-control" id="pTelefono" name="pTelefono" required>
                            </div>
                            <div class="form-group">
                                <label for="pFechaN">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="pFechaN" name="pFechaN" required>
                            </div>
                            <div class="form-group">
                                <label for="pCi">Cedula:</label>
                                <input type="text" class="form-control" id="pCi" name="pCi" required>
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
                    <button type="submit" class="btn btn-success offset-md-5">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
    incluirTemplate('footer');
?>