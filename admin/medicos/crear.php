<?php
    // session_start();
    // $auth=$_SESSION['login'];
    // if(!$auth){
    //     header('Location:/clinica');
    // }
    require '../../includes/config/database.php';
    $db=conectarDB();

    require '../../includes/funciones.php';
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
        <a style="margin: 20px;" href="/clinica/admin/medicos/listadoMedico.php" class="btn btn-success">Volver</a>
            <div class="formulario">
                <h2 class="mb-4">Registro de Medico</h2>
                <form method="post" action="/clinica/admin/medicos/registrarmedico.php" enctype="multipart/form-data">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nombre:</label>
                                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="">Paterno:</label>
                                    <input type="text" class="form-control" name="pat" id="pat" placeholder="Paterno">
                                </div>
                                <div class="form-group">
                                    <label for="">Materno:</label>
                                    <input type="text" class="form-control" name="mat" id="mat" placeholder="Materno">
                                </div>
                                <div class="form-group">
                                    <label for="">Telefono:</label>
                                    <input type="text" class="form-control" name="tel" id="tel" placeholder="Telefono">
                                </div>
                                <div class="form-group">
                                    <label for="">Nro CI:</label>
                                    <input type="text" class="form-control" name="ci" id="ci" placeholder="ci">
                                </div>
                                <div class="form-group">
                                    <label for="">Imagen:</label>
                                    <input type="file"  class="form-control" name="imagen" id="imagen" accept="image/jpeg, image/png"> <!--accept="image/jpeg, image/png"-->
                                </div>
                                <div class="form-group">
                                    <label for="">Especialidad:</label>
                                    <input type="text" class="form-control" name="esp" id="esp" placeholder="especialidad">
                                </div>
                                <div class="form-group">
                                    <label for="">Email:</label><br>
                                    <input type="email" class="form-control" id="em" name="em">
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña:</label><br>
                                    <input type="password" class="form-control" id="pas" name="pas">
                                </div>
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
