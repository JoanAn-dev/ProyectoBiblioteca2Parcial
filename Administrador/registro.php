<?php
    include '../conexion/conexion.php';
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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .contenido {
            margin-left: auto;
            margin-right: auto;
            padding: 30px;
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        td {
        padding: 12px 10px; /* Aumentado de 6px 4px a 12px 10px */
        font-size: 16px;
        }
        label {
            padding: 8px;
            font-weight: bold;
            color: black;
            text-align: center;
            font-size: 20px;
            display: block; 
        }
        input[type="text"], input[type="number"], input[type="img"], input[type="date"]{
            font-family: Arial, sans-serif;
            color: black;
            background-color: white;
            padding: 8px 12px; 
            font-size: 16px;
            margin: 4px;
            box-shadow: 2px 2px 2px gray;
            border-radius: 5px;
            text-align: left;
            width: 90%; 
            min-width: 250px;
        }
        table {
            font-family: Arial, sans-serif;
            border-radius: 1em;
            background-color: #A3BFD9;
            padding: 10px; 
            width: 90%; 
            border-color: #A3BFD9;
            margin-top: 20px;
            border-width: 8px;
        }
        body {
            background: linear-gradient(to bottom, #A3BFD9, #ced8e2);
            font-family: Arial, sans-serif;
        }
        select {
            font-family: Arial, sans-serif;
            color: black;
            background-color: white;
            padding: 8px 12px;
            font-size: 16px;
            margin: 4px;
            box-shadow: 2px 2px 2px gray;
            border-radius: 5px;
            text-align: left;
            width: 90%;
            min-width: 250px;
            border: 1px solid #ccc;
            height: auto;
        }


        select option {
            font-family: Arial, sans-serif;
            font-size: 16px;
            padding: 8px 12px;
            background-color: white;
            color: black;
        }
        input[type="button"], input[type="submit"] {
            background-color: white;
            border: none;
            color: black;
            font-weight: bold;
            padding: 10px 25px;
            text-align: center;
            font-size: 18px;
            margin: 6px;
            box-shadow: 4px 4px 4px black;
            font-family: Arial, sans-serif;
            border-radius: 5px;
            cursor: pointer;
        }

    </style>

        <div class="page-container">
            <?php
                include 'pag_alumno.php'
            ?>

            <div class="contenido">
                <center>
                    <form name="registrarAlumno" action="metodos.php" method="POST">
                    <table border="8" >
                        <tr>
                            <td colspan="8" align="center">
                                <label for="">Registro de alumnos</label>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="4" align="center">
                                    <label for="">Codigo del nuevo alumno</label>
                            </td>
                            <td colspan="4" align="center">
                                <input type="number" value="" maxlength="11" name="txtcodigo" >
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" align="center">
                                <label for="">Usuario</label>
                            </td>
                            <td colspan="4" align="center">
                                <input type="text" value="" maxlength="60" name="txtusuario" >
                        <tr>
                        <tr>
                            <td colspan="4" align="center">
                                <label for="">Contraseña del alumno</label>
                            </td>
                            <td colspan="4" align="center">
                                <input type="text" value="" maxlength="10" name="txtpassword" >
                        <tr>
                            <td colspan="8" align="center">
                                <input type="submit" value="Registrar" name="registrarAlumno">
                                <input type="submit" value="cancelar" name="Cancelar">
                            </td>
                        </tr>
                        
                    </table>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html>