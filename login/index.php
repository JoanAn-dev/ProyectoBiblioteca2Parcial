<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="caja1">
            <form method="POST" action="login.php">
                <div class="formtlo">Iniciar Sesion</div>
                <div class="ub1" >&#128273; Ingresar Codigo</div>
                <input type="text" name="txtcodigo" required>
                <div class="ub1" >&#128274; Ingresar Contraseña</div>
                <input type="password" name="txtpassword" id="txtpassword" required>
                <div class="ub1">
                    <input type="checkbox" onclick="verpassword()">Mostrar Contraseña
                </div>
                <div class="ub1">Rol</div>
                <select name="tipoUsuario" required>
                    <option value="" disabled selected>
                        <label>Seleccionar</label>
                    </option>
                    <option value="alumno">Alumno</option>
                    <option value="admin">Administrador</option>
                    
                </select>
                <div align="center">
                    <input type="submit" value="Ingresar">
                    <input type="reset" value="Cancelar">
                </div>
            </form>
        </div>
    </body>

    <script>
        function verpassword(){
            var tipo = document.getElementById("txtpassword");
            if (tipo.type == "password") {
                tipo.type = "text";
            } else {
                tipo.type = "password";
            }
        }
    </script>

</html>