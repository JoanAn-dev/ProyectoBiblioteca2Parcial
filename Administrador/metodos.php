<?php
    

    include ('../conexion/conexion.php');

    $isb = $_POST['txtisb'];
    $nombre = $_POST['txtnombre'];
    $autor = $_POST['txtautor'];
    $editorial = $_POST['txteditorial'];
    $año = $_POST['txtaño'];
    $edicion = $_POST['txtedicion'];
    $cantidad = $_POST['txtcantidad'];

    //MANEJO DE LA IMAGEN
    $foto = "";

    //VERIFICAMOS SI EL USUARIO SI SUBIO LA IMAGEN
    if (isset($_FILES['txtfoto']) && $_FILES['txtfoto']['error'] == 0) {
        //OBTENEMOS EL NOMBRE DEL ARCHIVO
        $foto = $_FILES['txtfoto']['name'];

        //MOVEMOS EL ARCHIVO A LA CARPETA IMG
        if(move_uploaded_file($_FILES['txtfoto']['tmp_name'], "../img/" . $foto)) {

            //CAMBIAMOS LOS PERMISOS PARA QUE TODOS PUEDAN LEER EL ARCHIVO
            @chmod("../img/" . $foto, 0666); // 0666 da permisos de lectura/escritura a todos
        }
    }


    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['registrarLibro'])) {
        if ($isb == "" AND $nombre == "" AND $autor == "" AND $editorial == "" AND $año == "" AND $edicion == "" AND $cantidad == "") {
            echo "<script>
                    alert('Debe rellenar todos los campos del formulario');
                    window.location.href = 'pag_admin.php';
                </script>";
        }

        $sqlregistrar = "INSERT INTO libros(isb, nombre, autor, editorial, año, edicion, cantidad, foto) VALUES('$isb', '$nombre', '$autor', '$editorial', '$año', '$edicion', '$cantidad', '$foto')";
        
        if (mysqli_query($conn, $sqlregistrar)) {
            header('Location:pag_admin.php');
            exit();
        } else {
            echo "Error: ".$sqlregistrar."<br>".mysqli_error($conn);
        }
        

    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editarLibro'])){
        if (empty($isb)) {
            echo "<script>
                    alert('No se ha encontrado el ISB');
                    window.location.href = 'pag_admin.php';
                </script>";
        }

        //INICIAMOS LA CONSULTA PARA MODIFICAR
        $sqlmodificar = "UPDATE libros SET ";
        $camposActualizar = array();

        //VERIFICAMOS CADA CAMPO Y LO AGREGAMOS AL ARRAY SOLO SI TIENE DATOS
        if (!empty($nombre)) {
            $camposActualizar[] = "nombre = '$nombre' ";
        }

        if (!empty($autor)) {
            $camposActualizar[] = "autor = '$autor' ";
        }

        if (!empty($editorial)) {
            $camposActualizar[] = "editorial = '$editorial' ";
        }

        if (!empty($año)) {
            $camposActualizar[] = "año = '$año' ";
        }

        if (!empty($edicion)) {
            $camposActualizar[] = "edicion = '$edicion' ";
        }

        if (!empty($cantidad)) {
            $camposActualizar[] = "cantidad = '$cantidad' ";
        }

        //VERIFICAMOS SI SE SUBIO UNA NUEVA IMAGEN
        if (!empty($foto)) {
            $camposActualizar[] = "foto = '$foto' ";
        }

        //VERIFICAMOS SI HAY CAMPOS PARA ACTUALIZARLOS
        if (count($camposActualizar) > 0) {
            //UNIMOS LOS CAMPOS EN UNA CONSULTA
            $sqlmodificar .= implode(", ", $camposActualizar); 

            //COMPLETAMOS LA CONSULTA CON LA CONDICION WHERE
            $sqlmodificar .= " WHERE isb = '$isb' ";

            //EJECUTAMOS LA CONSULTA
            if (mysqli_query($conn, $sqlmodificar)) {
                header('Location:pag_admin.php');
                exit();
            }else {
                echo "Error: ". $sqlmodificar . "<br>" . mysqli_error($conn);
            }
        }else {
            //SI NO HAY CAMPOS PARA ACTUALIZAR SIMPLEMENTE REDIRIGIMOS
            header('Location:pag_admin.php');
            exit();
        }
    }



    //PARA ESTE METODO LO QUE HACEMOS ES PRIMERO ELIMINAR LOS REGISTROS DONDE ESTE EL LIBRO DEBIDO A QUE HAY DEPENDENCIAS EN LAS TABLAS PRESTAMOACR Y PRESTAMOHIST
    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['eliminarLibro'])){

        $sqlGetFoto = "SELECT foto FROM libros WHERE isb = '$isb'";
        $resultFoto = mysqli_query($conn, $sqlGetFoto);

        if ($rowFoto = mysqli_fetch_assoc($resultFoto)) {
            $foto = $rowFoto['foto'];

            // ELIMINAMOS DE PRESTAMOACT
            $sqleliminar_prestamoAct = "DELETE FROM prestamoAct WHERE isb = '$isb'";
            mysqli_query($conn, $sqleliminar_prestamoAct);  

            // ELIMINAMOS DE PRESTAMOHIST
            $sqleliminar_prestamoHist = "DELETE FROM prestamoHist WHERE isb = '$isb'";
            mysqli_query($conn, $sqleliminar_prestamoHist);

            // ELIMINAMOS EL LIBRO
            $sqleliminarLibro = "DELETE FROM libros WHERE isb = '$isb'";
            if (mysqli_query($conn, $sqleliminarLibro)) {

                // ELIMINAMOS LA IMAGEN SI EXISTE EN LA CARPETA
                if (!empty($foto) && file_exists("../img/$foto")) {
                    unlink("../img/$foto");
                }

                header('Location:pag_admin.php');
                exit();
            } else {
                echo "Error: " . $sqleliminarLibro . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "No se encontró la foto del libro con ISB $isb";
        }
        
    }


    
    $codigoA = $_POST['txtcodigo'];
    $usuarioA = $_POST['txtusuario'];
    $passA = $_POST['txtpassword'];

    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['registrarAlumno'])){
        $sqlregistrarA = "INSERT INTO usuarios(codigo, usuario, pass, tipoUsuario) VALUES('$codigoA', '$usuarioA', '$passA', 'alumno')";
 
        if (mysqli_query($conn, $sqlregistrarA)) {
            echo "<script>
                    alert('Alumno registrado con éxito');
                    window.location.href = 'pag_admin.php';
                </script>";
        } else {
            echo "Error: ".$sqlregistrarA."<br>".mysqli_error($conn);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['Cancelar'])){
        header('Location: pag_admin.php');
        exit(); 
    }


?>

