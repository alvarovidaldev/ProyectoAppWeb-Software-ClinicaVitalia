<title>MEDICOS</title>
<?php 
    require '../../includes/funciones.php';
    incluirTemplate("header");
    include 'subheader.php';
?> <br>
<div class="container">
<h2 class="tituloTwo" style="text-align: center;"><span style="font-weight:bold;">VITALIA</span></h2>
        <div style="text-align: justify;"> 
            <img src="../../paginas/medicos/img/stafmedic.jpg" hspace="5" vspace="5" style="float: left;margin: 0 auto; width: 500px ;height:autopx;" /><!-- para que la imajen baya ala isquierda -->
     <p>
     Vitalia, un hospital reconocido en la región, ofrece una amplia variedad de especialistas altamente cualificados para abordar las necesidades de salud de sus pacientes.
     <br><br>
     En cardiología, cuentan con expertos en diagnóstico, tratamiento y prevención de enfermedades cardiovasculares, incluyendo ecocardiografías y cateterismos. En oncología, oncólogos especializados brindan tratamientos avanzados contra el cáncer. El equipo de ortopedia y traumatología se destaca en el tratamiento de lesiones musculoesqueléticas, desde cirugías de reemplazo hasta rehabilitación. En ginecología y obstetricia, se ofrece atención integral a la mujer, desde planificación familiar hasta cuidados pre y postnatales. Además, pediatras especializados cuidan la salud de los niños desde el nacimiento hasta la adolescencia. 
     <br><br>
     Vitalia se enorgullece de su enfoque preventivo y de bienestar, respaldado por un equipo completo de profesionales médicos y de apoyo. </p>
          </div>
        </div> 
        <br><br>
<h2 class="tituloTwo" style="text-align: center;"><span style="font-weight:bold;">MEDICOS</span></h2>

<section class="tarjeta1">
    

 
 <?php
         require '../../includes/config/database.php';
         $db=conectarDB();
        $con_sql = "SELECT m.* FROM medico m WHERE estado = 'Activo'";
            $res=mysqli_query($db,$con_sql);
            while($reg=$res->fetch_assoc())
            {
        ?>
        <div class="card">
        <div class="head">
            <div class="circle"></div>
            <div class="img">
            <img src="../../admin/medicos/imagenes/<?php echo $reg['imagen']; ?>" > 
            </div>
        </div>
        
        <div class="description">
            <h5><?php echo $reg['mNombre']." ".$reg['mPaterno']." ".$reg['mMaterno']; ?></h5>
            <h6><?php echo $reg['especialidad']; ?></h6>
            
            <p>&#128231; <?php echo $reg['email']; ?></p>
            <p>&#128222; <?php echo $reg['mTelefono']; ?></p>

        </div>

        <div class="contact">
            <a href="../../paginas/contacto/contacto.php">Contacto</a>
        </div>
       

    </div>
    <?php 
            }
        ?>
    </section>
   
<?php
    incluirTemplate("footer");
?>
