<?php
   
    
    require '../../includes/config/database.php';
    $db=conectarDB();

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Borrar</h1>
    <?php
        $cod=$_GET['cod'];
        $con_sql="UPDATE medico SET estado='Inactivo' where idMedico=$cod";
        $res=mysqli_query($db,$con_sql);
        if($res){
            echo "
                <script>
                    alert('Se elimino');
                    window.location='listadoMedico.php';
                </script>
                ";
        }
        else{
            echo "
                <script>
                    alert('No se elimino');
                </script>
                ";
        }
    ?>
</main>