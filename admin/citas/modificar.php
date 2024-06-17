<title>AGENDAR CITA - VITALIA</title>
<?php    
    //VALIDACIÓN DE ACCESO Y REDIRECCIÓN EN CASO DE QUE NO EXISTA AUTORIZACIÓN

    if(!isset($_SESSION)){session_start();}
    $auth=$_SESSION['login']?? false;
    if (!$auth){header('Location: /clinica/index.php');}

    require '../../includes/config/database.php';
    $db=conectarDB();

    //OBTENER DATOS DE LOS MÉDICOS

    $sql        ="SELECT * FROM medico";
    $medicos    = mysqli_query($db,$sql);

    //OBTENER DATOS DE LA CITA MÉDICA

    $idCita     =   $_GET['idCita'];
    $sql        =   "SELECT * FROM cita WHERE idCita='$idCita'";
    $resultado  =   mysqli_query($db,$sql);

    if($resultado->num_rows>0){
        $cita=mysqli_fetch_array($resultado);
        $fecha      =   $cita['fecha'];
        $hora       =   $cita['hora'];
        $motivo     =   $cita['motivo'];
        $idMedico   =   $cita['idMedico'];
        $idPaciente =   $cita['idPaciente'];
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
        <a style="margin: 20px;" href="/clinica/admin/citas/listado.php" class="btn btn-success">Volver</a>
            <div class="formulario">
                <h2 class="mb-4">Modificar Cita</h2>
                <form action="registrarModificacion.php" method="post">
                    <input type="hidden" name="idCita" value="<?=$idCita?>">
                    <input type="hidden" name="tipo" value="<?=$_SESSION['tipo']?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha">Fecha:</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value ="<?=$fecha?>" min = "<?=date('Y-m-d')?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora">Hora:</label>
                                <select name="hora" id="hora" class="form-control" value ="<?=$hora?>" required>
                                    <option value="">Selecciona un horario</option>
                                </select>
                            </div>  
                        </div>
                    </div>

                    <script>
                        document.getElementById('fecha').addEventListener('change', function() {
                            const fecha = document.getElementById('fecha').value;
                            if (fecha) {
                                const formData = new FormData();
                                formData.append('fecha', fecha);

                                fetch('horario.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    const horariosSelect = document.getElementById('hora');
                                    horariosSelect.innerHTML = '<option value="">Selecciona un horario</option>';
                                    data.forEach(hora => {
                                        const option = document.createElement('option');
                                        option.value = hora;
                                        option.textContent = hora;
                                        horariosSelect.appendChild(option);
                                    });
                                })
                                .catch(error => console.error('Error:', error));
                            }
                        });
                    </script>






                    <div class="row">
                        <div class="form-group">
                            <label for="idMedico">Médico</label>
                            <select name="idMedico" id="idMedico" class="form-control" value ="<?=$idMedico?>"required>
                                    <?php
                                        while($medico=mysqli_fetch_array($medicos)){
                                    ?>        
                                        <option  value="<?=$medico[0]?>"><?=$medico[5].' - Dr. '.$medico[1].' '.$medico[2].' '.$medico[3]?></option>
                                    <?php
                                        }
                                    ?>

                                </select>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo</label>
                            <textarea class="form-control" id="motivo" name="motivo" rows="5" required><?=$motivo?></textarea>
                        </div>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-success offset-md-5">Modificar Cita</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
    incluirTemplate('footer');
?>