

# 📚 Sistema de Biblioteca - Proyecto en PHP

Este es un sistema de gestión de biblioteca desarrollado en **PHP** con conexión a **MySQL**. Permite el inicio de sesión de dos tipos de usuarios: **Alumno** y **Administrador**, gestionando préstamos de libros y llevando un historial detallado.

---

## 📁 Estructura del Proyecto

```
/conexion/conexion.php        # Conexión a la base de datos
/index.php                    # Formulario de login
/login.php                    # Lógica de autenticación
/biblioteca.sql               # Script SQL de la base de datos
/Alumno/                      # Módulo de funcionalidades para el alumno
/Administrador/               # Módulo de funcionalidades para el administrador
```

---

## 🔐 Login (`index.php` & `login.php`)

El sistema de autenticación permite que el usuario acceda con un **código**, **contraseña** y **rol**. Según el rol seleccionado, se redirige al módulo correspondiente:

* `Alumno` → `Alumno/pag_alumno.php`
* `Administrador` → `Administrador/pag_admin.php`

### Formulario de Login

* Campos: `código`, `contraseña`, `tipo de usuario`
* Opción para mostrar/ocultar contraseña

### Validación:

* Se consulta la tabla `usuarios` para verificar credenciales y rol.
* Si es válido, se inicia la sesión y se redirige.
* En caso de error, muestra un mensaje.

---

## 🔌 Conexión a la Base de Datos (`conexion/conexion.php`)

```php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "biblioteca";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
```

---

## 🗃️ Base de Datos (`biblioteca.sql`)

La base de datos `biblioteca` contiene las siguientes tablas:

### `usuarios`

| Campo       | Tipo                    |
| ----------- | ----------------------- |
| codigo      | VARCHAR                 |
| usuario     | VARCHAR                 |
| pass        | VARCHAR                 |
| tipoUsuario | ENUM('admin', 'alumno') |

### `libros`

| Campo     | Tipo    |
| --------- | ------- |
| isb       | VARCHAR |
| nombre    | VARCHAR |
| autor     | VARCHAR |
| editorial | VARCHAR |
| año       | INT     |
| edicion   | VARCHAR |
| cantidad  | INT     |
| foto      | TEXT    |

### `prestamoAct` (Préstamos activos)

| Campo       | Tipo    |
| ----------- | ------- |
| id          | INT     |
| codigo      | VARCHAR |
| libro       | VARCHAR |
| fechaInicio | DATE    |
| fechaFin    | DATE    |

### `prestamoHist` (Historial de préstamos)

* Misma estructura que `prestamoAct`
* Representa los préstamos ya devueltos

---

## 👨‍🎓 Módulo Alumno (`Alumno/`)

### Funcionalidades disponibles:

* Realizar préstamos (`prestamo.php`)
* Ver préstamos activos (`prestamoAct.php`)
* Consultar historial (`historial.php`)
* Cerrar sesión (`cerrarSesion.php`)

---

### 📄 `pag_alumno.php`

Menú principal del alumno con enlaces a cada funcionalidad.

También muestra el nombre del alumno desde la sesión.

---

### 📚 `prestamo.php` – Realizar Préstamo

Formulario para registrar un nuevo préstamo:

* **Campos**:

  * Código del alumno (desde sesión)
  * Nombre del alumno
  * Libro (solo disponibles)
  * Fecha de inicio (mínimo: hoy)
  * Fecha de devolución

* **Acciones**:

  * Inserta en `prestamoAct`
  * Reduce en 1 el stock del libro

* **Validaciones**:

  * Fechas válidas
  * No permite préstamo sin stock

---

### 📋 `prestamoAct.php` – Préstamos Activos

* Muestra préstamos aún no devueltos del alumno
* Botón de "Devolver":

  * Elimina de `prestamoAct`
  * Inserta en `prestamoHist`
  * Aumenta en 1 el stock del libro

---

### 📜 `historial.php` – Historial

Muestra los préstamos devueltos por el alumno (de `prestamoHist`).

---

### 🔒 `cerrarSesion.php`

Código recomendado para cerrar sesión:

```php
<?php
session_start();
session_destroy();
header('Location: ../index.php');
exit;
```

Enlace en HTML:

```html
<a href="cerrarSesion.php"><button>Cerrar sesión</button></a>
```

---

## 🛠️ Módulo Administrador (`Administrador/`)

Funcionalidades disponibles:

* Ver menú principal (`pag_admin.php`)
* Registrar nuevos alumnos (`registro.php`)
* Registrar, editar y eliminar libros
* Ver historial de préstamos de todos los usuarios
* Control total de la base de datos

---

### 👤 `registro.php` – Registro de Alumnos

Formulario para que el administrador registre nuevos alumnos.

#### Campos del formulario:

* Código del alumno (`txtcodigo`)
* Nombre de usuario (`txtusuario`)
* Contraseña (`txtpassword`)

#### Estructura del formulario:

* Presentado en tabla con estilos CSS integrados
* Validación de campos (básica en HTML)
* Botones: `Registrar`, `Cancelar`

#### Acción:

* Al enviar, se manda a `metodos.php` donde se procesa el registro e inserta en la tabla `usuarios` con tipo `alumno`.

```php
if (isset($_POST['registrarAlumno'])) {
    $codigo = $_POST['txtcodigo'];
    $usuario = $_POST['txtusuario'];
    $pass = $_POST['txtpassword'];

    $insert = "INSERT INTO usuarios (codigo, usuario, pass, tipoUsuario) VALUES ('$codigo', '$usuario', '$pass', 'alumno')";
    mysqli_query($conn, $insert);
}
