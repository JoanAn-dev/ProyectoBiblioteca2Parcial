<?php
    session_start();
    include('../conexion/conexion.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registros de Alumnos</title>
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
                width: 80%;
                border-color: #A3BFD9;
                margin: 0 auto ; 
            }

            td{
                padding: 6px 4px; 
            }            
        </style>



    <div style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <table border="8" >

                <tr>
                    <td align="left" colspan="3">
                        <a href="pag_admin.php">
                            <input type="button" value="Regresar">
                        </a>
                    </td>
                </tr>
                <tr>
                    
                    <td colspan="3" align="center">
                        <h3>Usuarios Registrados</h3>
                    </td>
                    
                </tr>
                <tr>
                    <td align="center">
                        <label for="">Codigo</label>
                    </td>
                    <td align="center">
                        <label for="">Usuario</label>
                    </td>
                    <td align="center">
                        <label for="">Contraseña</label>
                    </td>
                </tr>

                <?php
                    $sql = "SELECT * FROM usuarios WHERE tipoUsuario = 'alumno'";
                    $result = mysqli_query($conn, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <td align="center"> <?php echo $mostrar['codigo'] ?> </td>
                    <td align="center"> <?php echo $mostrar['usuario'] ?> </td>
                    <td align="center"> <?php echo $mostrar['pass'] ?> </td>
                    
                </tr>
                    

                <?php
                    }
                ?>

            </table>
    </div>
            

    </body>
</html>