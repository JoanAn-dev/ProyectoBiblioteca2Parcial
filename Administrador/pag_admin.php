<?php
    include '../conexion/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrador</title>
    </head>
    <body>
        <style>
            input[type=button], input[type=submit]{
                background-color: white;
                border: none;
                color: black;
                font-weight: bold;
                padding: 6px 20px;
                text-align: center;
                font-size: 16px;
                margin: 4px 4px;
                box-shadow: 3px 3px 3px black;
                font-family: Arial;
                border-radius:5px;
                }
            input[type=text], input[type=number], input[type=file]  {
                font-family: Arial;
                color: black;
                background-color: white;
                padding: 4px;
                text-align: left;
                font-size: 16px;
                margin: 4px 4px;
                box-shadow: 2px 2px 2px;
                border-radius: 5px;
            }    
            body{
                background:rgb(174, 193, 211);

            }
            label{
                padding: 4px;
                font-weight: bold;
                color: black;
                text-align: center;
                font-size: 18px;
            }

            h2{
                font-weight: bold;
                color: black;
                text-align: center;
                font-size: 22px;
            }

            table{
                font-family: Arial;
                border-radius: 1em;
                background-color: #A3BFD9;
                padding: 5px 5px;
                width: 70%;
                border-color: #A3BFD9;
            }

            td{
                padding: 6px 4px; 
            }

            
        </style>

        <center>
            <form name="Metodos" action="metodos.php" method="POST" enctype="multipart/form-data">
            <table border="8" >
                <tr>
                    <td align="center">
                        <a href="../login/index.php">
                            <input type="button" value="Cerrar Sesion">
                        </a>
                    </td>
                    <td colspan="6" align="center">
                        <label>Bienvenido a la Pagina de Administrador</label>
                    </td>
                    <td  align="center">
                    <a href="registro.php"><input type="button" value="Registrar nuevo Alumno"></a>
                    <a href="alumnosRegistrados.php"><input type="button" value="Ver alumnos registrados"></a>
                    </td>
                    
                </tr>

                <tr>
                    <td colspan="8" align="center">
                        <h2>Registro de libros</h2>
                    </td>
                </tr>

                <tr >
                    <td colspan="2" align="center">
                        <label for="">ISB</label>
                    </td>
                    <td colspan="2" align="center">
                        <input type="text" value="" maxlength="20" name="txtisb" >
                    </td>
                    <td colspan="2" align="center">
                        <label for="">Nombre</label>
                    </td>
                    <td colspan="2" align="center">
                        <input type="text" value="" maxlength="120" name="txtnombre">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label for="">Autor</label>
                    </td>
                    <td colspan="2" align="center">
                        <input type="text" value="" maxlength="120" name="txtautor">
                    </td>
                    <td colspan="2" align="center">
                        <label for="">Editorial</label>
                    </td >
                    <td colspan="2" align="center">
                        <input type="text" value="" maxlength="120" name="txteditorial">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label for="">Año</label>
                    </td>
                    <td colspan="2" align="center">
                        <input type="text"  name="txtaño">
                    </td>
                    <td colspan="2" align="center">
                        <label for="">Edicion</label>
                    </td>
                    <td colspan="2" align="center">
                        <input type="text" value="" maxlength="40" name="txtedicion">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <label for="">Cantidad</label>
                    </td>
                    <td colspan="2" align="center">
                        <input type="number" value="" maxlength="4" name="txtcantidad">
                    </td>
                    <td colspan="2" align="center">
                        <label for="">Foto</label>
                    </td>
                    <td colspan="2" align="center">
                        <input type="file" name="txtfoto" id="foto">
                    </td>
                </tr>
                <tr>
                    <td colspan="8" align="center">
                        <input type="submit" value="Registrar nuevo libro" name="registrarLibro">
                        <input type="submit" value="Modificar" name="editarLibro">
                        <input type="submit" value="Eliminar" name="eliminarLibro">
                    </td>
                </tr>
                <tr>
                    <td colspan="8" >
                        <h2>Listado de libros en existencia</h2>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">ISB</label>
                    </td>
                    <td>
                        <label for="">Nombre</label>
                    </td>
                    <td>
                        <label for="">Autor</label>
                    </td>
                    <td>
                        <label for="">Editorial</label>
                    </td>
                    <td>
                        <label for="">Año</label>
                    </td>
                    <td>
                        <label for="">Edicion</label>
                    </td>
                    <td colspan="1">
                        <label for="">Cantidad</label>
                    </td>
                    <td>
                        <label for="">Foto</label>
                    </td>
                </tr>

                <?php
                    $sql = "SELECT * FROM libros";
                    $result = mysqli_query($conn, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td align="center"> <?php echo $mostrar['isb'] ?> </td>
                    <td align="center"> <?php echo $mostrar['nombre'] ?> </td>
                    <td align="center"> <?php echo $mostrar['autor'] ?> </td>
                    <td align="center"> <?php echo $mostrar['editorial'] ?> </td>
                    <td align="center"> <?php echo $mostrar['año'] ?> </td>
                    <td align="center"> <?php echo $mostrar['edicion'] ?> </td>
                    <td align="center"> <?php echo $mostrar['cantidad'] ?> </td>
                    <td align="center">
                         <?php
                            if (!empty($mostrar['foto'])) {
                                echo "<img width='120px' height='120px' src='../img/".$mostrar['foto']."' alt='".$mostrar['nombre']."' >";
                            } else {
                                echo "Sin imagen";
                            }
                            
                          ?> 
                    </td>
                </tr>
                    

                <?php
                    }
                ?>

            </table>
            </form>
            
        </center>
    </body>
</html>