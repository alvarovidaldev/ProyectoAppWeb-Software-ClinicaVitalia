<title>MEDICO</title>
<?php
    require '../../includes/config/database.php';
    $db=conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');
    $cod=$_GET['cod'];
    $tipo=$_SESSION['tipo'];
    //MODIFICA DATOS EL ADMINISTRADOR DEL MEDICO SELECCIONADO 
    if(isset($_POST['Modificar']))
    {
        
        //comentar estos campos por si acaso
        $var0=$_POST['nom'];
        $var1=$_POST['pat'];
        $var2=$_POST['mat'];
        $var3=$_POST['esp'];
        $var4=$_POST['tel'];
        // $var5=$_FILES['imagen']['name'];

    $con_sql = "UPDATE medico SET mNombre='$var0',mPaterno='$var1',mMaterno='$var2',especialidad='$var3',mTelefono='$var4' WHERE idMedico='$cod'";
        //,paterno='$var1',materno='$var2',telefono='$var3'
        $resm=mysqli_query($db,$con_sql);
        // if($resm){
        //     echo "
        //     <script> 
        //             window.alert('registro modificado con exito');
        //             window.location='listadoMedico.php';
        //     </script>
        //         ";
        // } 

        if($resm){
            if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE){
                $tmp=$_FILES['imagen']['tmp_name'];
                @copy($tmp,'imagenes/'.$cod);
                $sql = "UPDATE medico SET imagen = '$cod' WHERE idMedico = '$cod'";
                mysqli_query($db, $sql);
            }

            if ($tipo=='administradores'){
                    ?>
                        <script>
                            alert("SE REGISTRÓ LA MODIFICACIÓN");
                            window.location.href = "listadoMedico.php"
                        </script>
                    <?php
                }
                else{
                    ?>
                        <script>
                            alert("SE REGISTRÓ LA MODIFICACIÓN");
                            window.location.href = "/clinica/admin/indexM.php"
                        </script>
                    <?php
                }
        }
        else
            echo "ERROR";
            
    }
?>

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


    
    <?php 
        $consulta="select * from medico where idMedico='$cod'";
        $res=mysqli_query($db,$consulta);
        while($fila=mysqli_fetch_array($res))
        {
            $email = $fila['email'];
    ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a style="margin: 20px;" href="/clinica/<?=($tipo=='administradores'?'admin/medicos/listadoMedico':($tipo=='medicos'?'admin/indexM':($tipo=='pacientes'?'admin/indexP':'index')))?>.php" class="btn btn-success">Volver</a>
            <div class="formulario">

                <h2 class="mb-4">MODIFICAR DATOS</h2>
                <form action="modificarMedico.php?cod=<?php echo $fila['idMedico']; ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <td>Nombre</td>
                                <td><input type="text" class="form-control" name="nom" id="nom" value="<?php echo $fila['mNombre']; ?>"></td>
                            </div>

                            <div class="form-group">
                                <td>Paterno</td>
                                <td><input type="text" class="form-control" name="pat" id="pat" value="<?php echo $fila['mPaterno']; ?>"></td>
                            </div>

                            <div class="form-group">
                                 <td>Materno</td>
                                <td><input type="text" class="form-control" name="mat" id="mat" value="<?php echo $fila['mMaterno']; ?>"></td>
                            </div>

                            <div class="form-group">
                                <td>Imagen</td>
                                <td><input type="file" class="form-control" accept="image/jpeg, image/png" name="imagen" id="imagen" value="<?php echo $fila['imagen']; ?>"></td>
                            </div>

                            <div class="form-group">
                                 <td>especialidad</td>
                                <td><input type="text" class="form-control" name="esp" id="esp" value="<?php echo $fila['especialidad']; ?>"></td>
                            </div>

                            <div class="form-group">
                                <td>Telefono</td>
                                <td><input type="text" class="form-control" name="tel" id="tel" value="<?php echo $fila['mTelefono']; ?>"></td>
                            </div>
                            <br>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <!-- BOTON PARA EL MODAL -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#password">
                                    Modificar Acceso
                                    </button>
                                </div>
                            </div>

                            <button type="submit" name="Modificar" id="Modificar" value="Modificar" class="btn btn-success offset-md-5">Actualizar</button>
                            <!-- <td colspan="3"><div align="center"><input type="submit" name="Modificar" id="Modificar" value="Modificar" class="btn btn-primary"></td> -->
                            <!-- <td><div align="center"><a href="../vendedores/listado.php" class="btn btn-danger">Cancelar</a></div></td> -->
                            <?php
                                }
                            ?>
                        </div>
                    </div>
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
                        <input type="hidden" name="idMedico" value="<?= $cod ?>">

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
    incluirTemplate ('footer');
?>