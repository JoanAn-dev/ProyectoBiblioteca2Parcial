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
                    
                    <table border="8" >


                <?php
                    $codigoAlumno = $_SESSION['codigo'];

                    $sql = "SELECT usuario FROM usuarios Where codigo = '$codigoAlumno' ";
                    $result = mysqli_query($conn, $sql); 
                    
                    $mostrar= mysqli_fetch_array($result);
                ?>

                 <tr>
                    <td colspan="5" align="center">
                        <h3>Alumno logueado:    <?php echo $mostrar['usuario'] ?> </h3>
                    </td>
                </tr>

                <tr>
                    <td colspan="5" align="center">
                        <h2>Consulta de Prestamos Activos</h2>
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
                        <label for="">Accion</label>
                    </td>

                </tr>

                <?php
                    $codigoAlumno = $_SESSION['codigo'];

                    $sql = "SELECT * FROM prestamoAct WHERE codigo= '$codigoAlumno'";
                    $result = mysqli_query($conn, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td align="center"> <?php echo $mostrar['id_prestamo'] ?> </td>
                    <td align="center"> <?php echo $mostrar['libro'] ?> </td>
                    <td align="center"> <?php echo $mostrar['fecha_inicio'] ?> </td>
                    <td align="center"> <?php echo $mostrar['fecha_termino'] ?> </td>
                    <td>
                        <form name="mostrarHistorialPrestamos" action="Funcionalidad/mostrarHistorialPrestamos.php" method="POST" onsubmit="return confirmarEntrega()">
                        <input type="hidden" name="txtid_prestamo" value="<?php echo $mostrar['id_prestamo'] ?>">
                        <input type="hidden" name="txtisb" value="<?php echo $mostrar['isb'] ?>">
                        <input type="submit" value="Entregar libro" name="entregarLibro">
                        </form>
                    </td>
                </tr>

                <?php
                    }
                ?>
                 
                    </table>
                    
                </center>
            </div>
        </div>
        <script>
            function confirmarEntrega(){
                return confirm("¿Esta seguro que desea entregar este libro?");
            }
        </script>
    </body>
</html>