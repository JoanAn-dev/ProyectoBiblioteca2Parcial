<?php
    session_start();
    include('../../conexion/conexion.php');

    

    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['entregarLibro'])) {

        $id_prestamo = $_POST['txtid_prestamo'];
        $isb = $_POST['txtisb'];

        $sql1 = "UPDATE libros SET cantidad = cantidad + 1 WHERE isb = '$isb' ";
        $actualizarStock = mysqli_query($conn, $sql1);

        $sql2 = "DELETE FROM prestamoAct WHERE id_prestamo = '$id_prestamo' ";
        $borrarRegistro = mysqli_query($conn, $sql2);

        if ($actualizarStock && $borrarRegistro) {
            header('Location: ../prestamoAct.php');
        }

    }

?>