<?php
    include('../../conexion/conexion.php');
    
    $codigo = $_POST['codigo'];
    $usuario = $_POST['txtusuario'];
    $fechai = $_POST['txtfechaInicio'];
    $fechaf = $_POST['txtfechaFin'];
    $lib = $_POST['txtlibro'];

    $sql= "SELECT isb FROM libros WHERE nombre = '$lib' ";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $isblibro = $fila['isb'];


    

    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['registrarPrestamo'])) {
        $sqlregistrar = "INSERT INTO prestamoAct( codigo, usuario, fecha_inicio, fecha_termino, libro, isb) VALUES('$codigo', '$usuario', '$fechai', '$fechaf', '$lib', '$isblibro' )";
        $sqlregistrarHist = "INSERT INTO prestamoHist( codigo, usuario, fechaI, fechaF, libro, isb) VALUES( '$codigo', '$usuario', '$fechai', '$fechaf', '$lib', '$isblibro' )";
        
        $guardar1 = mysqli_query($conn, $sqlregistrar);
        $guardar2 = mysqli_query($conn, $sqlregistrarHist);

        if ($guardar1 && $guardar2){
            $sqlDescontar = "UPDATE libros SET cantidad = cantidad - 1 WHERE isb = '$isblibro' ";
            $actualizar = mysqli_query($conn, $sqlDescontar);

            if ($sqlDescontar) {
                header('Location: ../prestamoAct.php');
            }
            
        }else {
            echo "Error: ".$guardar1."<br>".mysqli_error($conn);
            echo "Error: ".$guardar2."<br>".mysqli_error($conn);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['limpiarCampos'])){
        header('Location: pag_admin.php');
        exit(); 
    }

?>