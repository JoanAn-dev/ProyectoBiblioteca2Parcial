<nav class="nav">
    <ul class="list">
        <!-- Contenedor para las opciones del menú -->
        <div class="menu-options">
            <li class="list__item">
                <div class="list__button">
                    <img src="../iconos/formulario1.png" class="list__img iconos"> 
                    <a href="prestamo.php" class="nav__link">Realizar un prestamo</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="../iconos/prestamo.png" class="list__img iconos">
                    <a href="prestamoAct.php" class="nav__link">Consultar prestamos activos</a>
                </div>
            </li>
        
            <li class="list__item">
                <div class="list__button">
                    <img src="../iconos/historial.png" class="list__img iconos">
                    <a href="prestamoHist.php" class="nav__link">Consultar historial de prestamos</a>
                </div>
            </li>
        </div>
        
        <!-- Botón de cerrar sesión -->
        <li class="list__item cerrarSesion">
            <a href="../login/index.php">
				
                <input type="submit" value="Cerrar Sesion">
            </a>
        </li>
    </ul>
</nav>