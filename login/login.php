/*<?php
    session_start();
    include('../conexion/conexion.php');

    $cod = $_POST["txtcodigo"];
    $pass = $_POST["txtpassword"];
    $tipoUsuario = $_POST["tipoUsuario"];

    /**/

    //VALIDAMOS LOS DATOS
    $queryusuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE codigo = '$cod' AND pass = '$pass' AND tipoUsuario = '$tipoUsuario' ");

    $nr = mysqli_num_rows($queryusuario);

    if ($nr == 1) {
        //GUARDAMOS LOS DATOS DEL USUARO EN LA SESION
        session_start();
        $_SESSION['codigo'] = $cod;
        $_SESSION['pass'] = $pass;
        $_SESSION['tipoUsuario'] = $tipoUsuario;


        
        if ($tipoUsuario == "admin") {
            header("Location: ../Administrador/pag_admin.php");
        } else if($tipoUsuario == "alumno"){
            header("Location: ../Alumno/prestamoAct.php");
        }
        
    }else{
        echo"
            <script>
                alert('Usuario, contraseña o rol incorrectos');
                window.location = 'index.php';
            </script>
        ";
    }


?>