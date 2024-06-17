<?php
    function conectarDB(){
        $hostname='localhost';
        $username='root';
        $password='';
        $database='vitalia';
        $bd=mysqli_connect($hostname,$username,$password,$database);
        if($bd){
            return $bd;

        }
        else{
            echo 'Error de conexión';
        }
    }

?>
