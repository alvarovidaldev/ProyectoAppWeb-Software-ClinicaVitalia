<title>ADMINISTRADOR</title>
<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    //CONEXION A BASE DE DATOS

    require '../../includes/config/database.php';
    $db=conectarDB();

    //NO SE USA $_SESSION['idUsuario'] YA QUE ESTA SECCIÓN TAMBIEN SERÁ LLAMADA DESDE EL LISTADO

    $idAdministrador=$_GET['idAdministrador'];

    //RECUPERACIÓN DE DATOS PARA MODIFICACIÓN

    $sql="SELECT * FROM administrador WHERE idAdministrador=$idAdministrador";
    $resultado=mysqli_query($db,$sql);

    if($resultado->num_rows>0){
        $paciente=mysqli_fetch_assoc($resultado);

        $aNombre    =   $paciente["aNombre"];
        $aPaterno   =   $paciente["aPaterno"];
        $aMaterno   =   $paciente["aMaterno"];
        $aTelefono  =   $paciente["aTelefono"];
        $aCi        =   $paciente["aCi"];
        $email      =   $paciente["email"]; //NO SE RECUPERA EL PASSWORD PORQUE ESTA HASHEADO Y SE RETROALIMENTARIA

    }    
    
    //SE INCLUYE EL HEADER

    include'../../includes/funciones.php';
    incluirTemplate('header');
?>

<!-- FORMULARIO DE MODIFICACIÓN -->
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
                <form action="modificarAdministrador.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- EN EL FORMULARIO SE ENVIA EL ID DEL PACIENTE Y EL TIPO -->

                            <input type="hidden" name='idAdministrador' value=<?=$idAdministrador?>> 
                            <input type="hidden" name='tipo' value=<?=$_SESSION['tipo']?>> 
                            
                            <div class="form-group">
                                <label for="aNombre">Nombre:</label>
                                <input type="text" class="form-control" id="aNombre" name="aNombre" value="<?=$aNombre?>"required>
                            </div>
                            <div class="form-group">
                                <label for="aPaterno">Apellido Paterno:</label>
                                <input type="text" class="form-control" id="aPaterno" name="aPaterno" value="<?=$aPaterno?>">
                            </div>
                            <div class="form-group">
                                <label for="aMaterno">Apellido Materno:</label>
                                <input type="text" class="form-control" id="aMaterno" name="aMaterno" value="<?=$aMaterno?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="aTelefono">Teléfono:</label>
                                <input type="tel" class="form-control" id="aTelefono" name="aTelefono" value="<?=$aTelefono?>" required>
                            </div>
                            <div class="form-group">
                                <label for="aCi">CI:</label>
                                <input type="text" class="form-control" id="aCi" name="aCi" value="<?=$aCi?>" required>
                            </div>                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">

                            <!-- BOTON PARA EL MODAL -->

                            <br>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#password">
                                Modificar Acceso
                            </button>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success offset-md-5">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE MODIFICACIÓN DE ACCESO -->

<div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modificar Acceso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="modificarAcceso.php" method="post" class="form-group col-md-6 offset-md-3">
                    <div class="modal-body">
                        <input type="hidden" name="tipo" value="<?= $_SESSION['tipo'] ?>">  
                        <input type="hidden" name="idAdministrador" value="<?= $idAdministrador ?>">

                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>            
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
incluirTemplate('footer');
?>