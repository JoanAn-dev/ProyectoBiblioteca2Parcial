<?php
    session_start();
    include '../conexion/conexion.php';
    include 'pag_alumno.php'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Realizar Prestamo</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="page-container">
            <?php
                include 'pag_alumno.php'
            ?>

            <div class="contenido">
                <center>
                    <form name="mostrarHistorialPrestamos" action="Funcionalidad/mostrarHistorialPrestamos.php" method="POST">
                    <table border="8" >

                <?php
                    $codigoAlumno = $_SESSION['codigo'];

                    $sql = "SELECT usuario FROM usuarios Where codigo = '$codigoAlumno' ";
                    $result = mysqli_query($conn, $sql); 
                    
                    $mostrar= mysqli_fetch_array($result);
                ?>

                 <tr>
                    <td colspan="8" align="center">
                        <h3>Alumno logueado:    <?php echo $mostrar['usuario'] ?> </h3>
                    </td>
                </tr>

                <tr>
                    <td colspan="8" align="center">
                        <h2>Historial de Prestamos</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">ID del prestamo</label>
                    </td>
                    <td>
                        <label for="">Libro</label>
                    </td>
                    <td>
                        <label for="">Fecha de inicio</label>
                    </td>
                    <td>
                        <label for="">Fecha de finalizacion</label>
                    </td>
                    <td>
                        <label for="">Imagen</label>
                    </td>

                </tr>

                <?php
                    $codigoAlumno = $_SESSION['codigo'];

                    $sql = "SELECT * FROM prestamoHist WHERE codigo = '$codigoAlumno'";
                    $result = mysqli_query($conn, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {

                        $isb = $mostrar['isb'];

                        $sql1 = "SELECT foto FROM libros WHERE isb = '$isb' ";
                        $fila = mysqli_query($conn, $sql1);
                        $mostrarfoto= mysqli_fetch_assoc($fila);

                ?>

                <tr>
                    <td align="center"> <?php echo $mostrar['id_historial'] ?> </td>
                    <td align="center"> <?php echo $mostrar['libro'] ?> </td>
                    <td align="center"> <?php echo $mostrar['fechaI'] ?> </td>
                    <td align="center"> <?php echo $mostrar['FechaF'] ?> </td>
                    <td align="center"> <?php echo "<img width='120px' height='120px' src='../img/".$mostrarfoto['foto'].".png' '>" ?> </td>
                </tr>

                <?php
                    }
                ?>
                        
                    </table>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html>