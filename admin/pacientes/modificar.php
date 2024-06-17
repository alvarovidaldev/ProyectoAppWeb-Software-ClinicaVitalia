<title>PACIENTE</title>
<?php
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    //CONEXION A BASE DE DATOS

    require '../../includes/config/database.php';
    $db=conectarDB();

    //NO SE USA $_SESSION['idUsuario'] YA QUE ESTA SECCIÓN TAMBIEN SERÁ LLAMADA DESDE EL LISTADO

    $idPaciente=$_GET['idPaciente'];

    //RECUPERACIÓN DE DATOS PARA MODIFICACIÓN

    $sql="SELECT * FROM paciente WHERE idPaciente=$idPaciente";
    $resultado=mysqli_query($db,$sql);

    if($resultado->num_rows>0){
        $paciente=mysqli_fetch_assoc($resultado);

        $pNombre    =   $paciente["pNombre"];
        $pPaterno   =   $paciente["pPaterno"];
        $pMaterno   =   $paciente["pMaterno"];
        $pTelefono  =   $paciente["pTelefono"];
        $pFechaN    =   $paciente["pFechaN"];
        $pCi        =   $paciente["pCi"];
        $email      =   $paciente["email"]; //NO SE RECUPERA EL PASSWORD PORQUE ESTA HASHEADO Y SE RETROALIMENTARIA

    }    

    //TIPO

    $tipo = $_SESSION['tipo']?? false;
    
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
            <a style="margin: 20px;" href="/clinica/<?=($tipo=='administradores'?'admin/pacientes/listado':($tipo=='medicos'?'admin/indexM':($tipo=='pacientes'?'admin/indexP':'index')))?>.php" class="btn btn-success">Volver</a>
            <div class="formulario">
                
                <h2 class="mb-4">Registro de Paciente</h2>
                <form action="modificarPaciente.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- EN EL FORMULARIO SE ENVIA EL ID DEL PACIENTE Y EL TIPO -->

                            <input type="hidden" name='idPaciente' value=<?=$idPaciente?>> 
                            <input type="hidden" name='tipo' value=<?=$_SESSION['tipo']?>> 
                            
                            <div class="form-group">
                                <label for="pNombre">Nombre:</label>
                                <input type="text" class="form-control" id="pNombre" name="pNombre" value="<?=$pNombre?>"required>
                            </div>
                            <div class="form-group">
                                <label for="pPaterno">Apellido Paterno:</label>
                                <input type="text" class="form-control" id="pPaterno" name="pPaterno" value="<?=$pPaterno?>">
                            </div>
                            <div class="form-group">
                                <label for="pMaterno">Apellido Materno:</label>
                                <input type="text" class="form-control" id="pMaterno" name="pMaterno" value="<?=$pMaterno?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pTelefono">Teléfono:</label>
                                <input type="tel" class="form-control" id="pTelefono" name="pTelefono" value="<?=$pTelefono?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pFechaN">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="pFechaN" name="pFechaN" value="<?=$pFechaN?>" required>
                            </div>
                            <div class="form-group">
                                <label for="pCi">CI:</label>
                                <input type="text" class="form-control" id="pCi" name="pCi" value="<?=$pCi?>" required>
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
                        <input type="hidden" name="idPaciente" value="<?= $idPaciente ?>">

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