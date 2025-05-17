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

            <div class="contenido">
                
                <center>
                    <form name="guardarPrestamo" action="Funcionalidad/guardarPrestamo.php" method="POST">
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
                                <label for="">Pagina para realizar prestamos</label>
                            </td>
                        </tr>
                        </tr> 

                            <td colspan="4" align="center">
                                <label for="">Libro</label>
                            </td>
                            <td colspan="4" align="center">
                                <select name="txtlibro" required>
                                    
                                    <option value="" disabled selected>Seleccione un libro</option>

                                    <?php
                                        $sql = "SELECT nombre FROM  libros";

                                        $resultado = mysqli_query($conn, $sql);

                                        while ($mostrar = mysqli_fetch_array($resultado)) {
                                            # code...
                                        
                                    ?>

                                        <option>
                                            <?php echo $mostrar['nombre'] ?>
                                        </option>    


                                    <?php
                                        }
                                    ?>


                                </select>
                            </td>


                        </tr>



                        <tr>
                            <td colspan="4" align="center">
                                    <label for="">Codigo del alumno</label>
                            </td>
                            <td colspan="4" align="center">
                                <input type="number" value="<?php echo $codigoAlumno ?>" disabled>
                                <input type="hidden" name="codigo" value="<?php echo $codigoAlumno ?>">
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" align="center">
                                <label for="">Usuario</label>
                            </td>

                            <td colspan="4" align="center">
                                 <?php 
                                    $codigoAlumno = $_SESSION['codigo'];

                                    $sql = "SELECT usuario FROM usuarios Where codigo = '$codigoAlumno' ";
                                    $result = mysqli_query($conn, $sql); 
                                    
                                    $mostrar= mysqli_fetch_array($result);
                                 ?>   

                                <input type="text" value="<?php echo $mostrar['usuario'] ?>"disabled>
                                <input type="hidden" name="txtusuario" value="<?php echo $mostrar['usuario'] ?>">

                            </td>

                        </tr>
                        
                            <td colspan="4" align="center">
                                <label for="">Fecha de inicio</label>
                            </td >
                            <td colspan="4" align="center">
                                <input type="date" name="txtfechaInicio" required>
                            </td>
                        
                        <tr>
                            <td colspan="4" align="center">
                                <label for="">Fecha de termino</label>
                            </td>
                            <td colspan="4" align="center">
                                <input type="date"  name="txtfechaFin" required>
                            </td>                      
                        <tr>

                        

                        <tr>
                            <td colspan="8" align="center">
                                <input type="submit" value="Realizar prestamo" name="registrarPrestamo">
                            </td>
                        </tr>
                        
                    </table>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html>