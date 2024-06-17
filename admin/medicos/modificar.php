<title>MEDICO</title>
<?php
    require '../../includes/config/database.php';
    $db=conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');
    
    $idMedico=$_GET['idMedico'];

    if(isset($_POST['Modificar']))
    {
        $var=$_POST['nom'];
        //comentar estos campos por si acaso
        $var1=$_POST['pat'];
        $var2=$_POST['mat'];
        $var3=$_POST['esp'];
        $var4=$_POST['tel'];
        $var5=$_FILES['ima']['name'];

        $con_sql = "UPDATE medico SET mTelefono='$var4',imagen='$var5' WHERE idMedico='$idMedico'";
        //,paterno='$var1',materno='$var2',telefono='$var3'
        $resm=mysqli_query($db,$con_sql);
        if($resm){
            
            echo "
            <script> 
                    window.alert('registro modificado con exito');
                    window.location='/clinica/admin/indexM.php';
            </script>
                ";
        } 
            $p1=$_POST['pas1'];
            $p2=$_POST['pas2'];
            if(strcmp($p1,$p2)==0){
                $pashash=password_hash($p1,PASSWORD_DEFAULT);
                $con_sql2="INSERT INTO medico (pasword) values('$pashash')";
                $res=mysqli_query($db,$con_sql2);
            }
    }
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
    <?php 
        $consulta="select * from medico where idMedico='$idMedico'";
        $res=mysqli_query($db,$consulta);
        while($fila=mysqli_fetch_array($res))
        {
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a style="margin :20px;" href="/clinica/admin/indexM.php" class="btn btn-success">Volver</a>
                <div class="formulario">

                    <h2 class="mb-4">Registro de Medico</h2>
                    <form action="modificar.php?cod=<?php echo $fila['idMedico']; ?>" method="post">
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
                                    <td><input type="file" class="form-control" accept="image/jpeg, image/png" name="ima" id="ima"></td>
                                </div>

                                <div class="form-group">
                                    <td>especialidad</td>
                                    <td><input type="text" class="form-control" name="esp" id="esp" value="<?php echo $fila['especialidad']; ?>"></td>
                                </div>

                                <div class="form-group">
                                    <td>Telefono</td>
                                    <td><input type="text" class="form-control" name="tel" id="tel" value="<?php echo $fila['mTelefono']; ?>"></td>
                                </div>

                                <div class="form-group">
                                    <td>Gmail</td>
                                    <td><input type="text" class="form-control" name="em" id="em" value="<?php echo $fila['email']; ?>"></td>
                                </div>

                                <div class="form-group">
                                    <td>Password</td>
                                    <td><input type="text" class="form-control" name="pas1" id="pas1" ></td>
                                </div>

                                <div class="form-group">
                                    <td>Confirmar Password</td>
                                    <td><input type="text" class="form-control" name="pas2" id="pas2" ></td>
                                </div>
                                <br>
                                <button type="submit" name="Modificar" id="Modificar" value="Modificar" class="btn btn-success offset-md-5">Actualizar</button>
                                <!-- <input type="submit" name="Modificar" id="Modificar" value="Modificar" class="btn btn-success offset-md-5"> -->
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
<?php
    incluirTemplate ('footer');
?>