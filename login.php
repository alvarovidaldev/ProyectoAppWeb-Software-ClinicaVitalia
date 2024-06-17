<title>LOGIN-VITALIA</title>
<?php
    require 'includes/config/database.php';
    $db = conectarDB();
    $errores = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $e = mysqli_real_escape_string($db, $_POST['ema']);
        $p = mysqli_real_escape_string($db, $_POST['pas']);
        $tipo = mysqli_real_escape_string($db, $_POST['tipo']);

        if (!$e) {
            $errores[] = "El correo es obligatorio";
        }
        if (!$p) {
            $errores[] = "La contraseña es obligatoria";
        }
        if (!$tipo) {
            $errores[] = "Debes seleccionar un tipo de usuario";
        }
        if (empty($errores)) {
            if ($tipo == 'administradores') {
                $con_sql = "SELECT * FROM administrador WHERE email='$e'";
            }if ($tipo == 'medicos') {
                $con_sql = "SELECT * FROM medico WHERE email='$e'";
            }if ($tipo == 'pacientes') {
                $con_sql = "SELECT * FROM paciente WHERE email='$e'";
            }
            $res = mysqli_query($db, $con_sql);
            if ($res->num_rows) {
                $usuario = mysqli_fetch_array($res);
                $auth = password_verify($p, $usuario['pasword']);
                if ($auth) {
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['tipo'] = $tipo;
                    $_SESSION['login'] = true;
                    $_SESSION['idUsuario'] = $usuario[0]; //idUsuario
                    switch ($tipo) {
                        case 'administradores':
                            header('Location: /clinica/admin/indexA.php');
                            break;
                        case 'medicos':
                            header('Location: /clinica/admin/indexM.php');
                            break;
                        case 'pacientes':
                            header('Location: /clinica/admin/indexP.php');
                            break;
                    }
                } else {
                    $errores[] = "La contraseña es incorrecta";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        }
    }

    require 'includes/funciones.php';
    incluirTemplate('header');

?>
<style>

    .bg{
        background-image: url(build/img/fondoA.jpg);
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }

</style>
<div class="container w-75 bg-primary mt-5 mb-5 rounded shadow">
    <div class="row align-items-stretch">
        <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

        </div>
        <div class="col bg-white p-5 rounded-end">

            <h2 class="fw-bold text-center py-5">Bienvenido</h2>

            <!-- FORMULARIO PARA LOGIN DE CORREO ELECTRONICO Y CONTRASEÑA -->

            <form method="POST" class="formulario">
                <div class="mb-4">
                    <label for="email" class="form-label">Correo electronico</label>
                    <input type="email" class="form-control" name="ema" id="ema">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="pas" id="pas">
                </div>
                
                <!-- VALIDAR USUARIO TIPO ADMINISTRADOR - PACIENTE - MEDICO -->
            
                <div class="my-3">
                    
                    <h5 class="text-center fw-bold">SELECCIONE EL TIPO DE USUARIO</h5>
                    <label for="tipo" class="text-center"></label>
                    <select id="tipo" name="tipo" class="form-select">
                        <option value="">Selecciona un tipo</option>
                        <option value="administradores">Administrador</option>
                        <option value="pacientes">Paciente</option>
                        <option value="medicos">Medico</option>
                    </select>
                    
                </div>

                <!-- BOTON DE INICIO DE SESION -->

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary w-100" >Iniciar Sesion</button>
                </div> <br>

                <!-- REGISTRO DE PACIENTE -->

                <span>No tienes cuenta? <a href="admin/pacientes/crear.php" class="text-decoration-none fw-bold"> Registrate como paciente</a></span>
            </form>
        </div>
    </div>
</div>


<?php
    // MOSTRAR ERRORES SI EXISTE A LA HORA DE LOGEARSE
    if (!empty($errores)) {
        echo '<script>';
        echo 'let errorMessages = "";';
        foreach ($errores as $error) {
            echo 'errorMessages += "' . htmlspecialchars($error) . '\\n";';
        }
        echo 'alert(errorMessages);';
        echo '</script>';
    }
?>


<!-- SCRIPT DEL BOOSTRAP 5 -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- INCLUIMOS EL FOOTER -->

<?php
    incluirTemplate("footer");
?>