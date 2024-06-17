<?php

    require_once('../../dompdf/autoload.inc.php');
    use Dompdf\Dompdf;
    session_start();

    require '../../includes/config/database.php';
    $db=conectarDB();
    $id=$_GET['idAtencion'];

    $sql="  SELECT a.*,p.*,m.* 
            FROM atencion a
            JOIN paciente p ON a.idPaciente = p.idPAciente
            JOIN medico m ON a.idMedico=m.idMedico
            WHERE a.idAtencion='$id'";

    $resultado = mysqli_query($db,$sql);

    if($resultado){
        $atencion=mysqli_fetch_array($resultado);
        $paciente = $atencion['pNombre'].' '.$atencion['pPaterno'].' '. $atencion['pMaterno'];
        $medico = $atencion['mNombre'].' '.$atencion['mPaterno'].' '. $atencion['mMaterno'] ; 

    }

    function fecha($fecha_iso){
        $fecha = new DateTime($fecha_iso);
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];
        $dia = $fecha->format('j'); // Día del mes
        $mes = $fecha->format('n'); // Mes como número sin ceros a la izquierda
        $nombre_del_mes = $meses[$mes]; // Obtener el nombre del mes en español
        $anio = $fecha->format('Y'); // Año en formato de 4 dígitos
        
        $fecha_formateada = "$dia de $nombre_del_mes de $anio";     
        return $fecha_formateada; 
    }
    
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe</title>
    <style>
                .contenidoInforme{
                    
                    position: relative;
                    top: 2.5cm;
                    /* display: flex;            
                    flex-direction: column;
                    align-items: center; */
                    margin-left: 2cm;
                    margin-right: 2cm;
                    margin-bottom: 3cm;
                    /* width:10cm; */
                    /* margin-left:17.5cm; */
 

                }
                .encabezado{
                    position: fixed;
                    top: 0;
                    left: 50%;
                    transform: translateX(-50%);           

                }
                .encabezado img{
                    width: 10cm;
                }
                .tipo{
                    text-align: center;
                }

                .remitente{
                    position: relative;
                    left: 50%;
                    transform: translateX(-50%);     

                    padding: 0.5cm;
                    border-bottom: 2px solid black;
                }
                .remitente span{
                    padding-bottom: 5px;
                }
                .ref1{
                    display: inline-block;            
                    width:1cm;
                    text-align: right;
                    margin-right: 1cm;
                }
                .ref2{
                    display: inline-block;            
                    width: 12cm;
                    text-align: left;
                }
                .remitente div{
                    position: relative;
                    top: 0;
                    text-align: left;

                }
                .cuerpo{
                    
                    /* margin: 1cm 3cm 3cm 3cm; */
                    text-align: justify;
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                }
                .pie{
                    position: relative;
                    width: 8cm;
                    left: 50%;
                    transform: translateX(-50%);            
                    border-top: 2px solid black;
                    text-align: center;
                    align-self: center;
                    margin-top: 3cm;
                }
                pre {
                    text-align: left;
                    text-justify: inter-word;
                    word-spacing: 0.1em;
                    font-family:'Times New Roman', Times, serif;
                    white-space: pre-wrap; 
                    word-wrap: break-word; 
                    overflow-x: auto;
                }
                i{
                    text-align: justify;
                }    


            </style>
</head>
<body>
    <div class="encabezado">
        <img src="http://<?=$_SERVER['HTTP_HOST']?>/clinica/build/img/logo_largo_sin_fondo.png">
     </div>   
    <div class="contenidoInforme">

        <div class="tipo">
            <br><br><br><br>
            <h1>INFORME MÉDICO</h1>
        </div>

        <div class="remitente">
            <div>
                <span class="ref1"><strong>Paciente:</strong></span>
                <span class="ref2"><?=$paciente?></span>
            </div>
            <div>
                <span class="ref1"><strong>Médico:</strong></span>
                <span class="ref2">Dr. <?=$medico?></span>
            </div>       

            <div>
                <span class="ref1"><strong>Fecha:</strong></span>
                <span class="ref2"><?=fecha($atencion['fechaAtencion'])?></span>
            </div>            
        </div>

        <div class="cuerpo">
            <br><br>
            <strong>Diagnóstico:</strong>
            <p>Basado en los síntomas presentados y los hallazgos clínicos, el diagnóstico provisional es:</p>
            <p><?=$atencion['diagnostico']?></p>

            <br><br>
            <strong>Plan de Tratamiento:</strong>
            <p>Con base en el diagóstico se considera el siguiente tratamiento:</p>
            <p><?=$atencion['tratamiento']?></p>  

            <div class="pie">
                <h4>
                    Dr. <?=$medico?><br>
                    <?=$atencion['mTelefono']?><br>

                </h4>
            </div>
        </div>
    </div>

</body>
</html>

<!-- EXPORTAR A PDF -->
<?php
    $html=ob_get_clean();
    // echo $html;
    $dompdf= new Dompdf();
    $options= $dompdf->getOptions();
    $options->set(array('isRemoteEnabled'=>true));
    $dompdf->setOptions($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    $dompdf->render();
    $nombreArchivo= "Informe - ".$paciente.".pdf";
    $dompdf->stream($nombreArchivo,array("Attachment"=>false));       
        
?>