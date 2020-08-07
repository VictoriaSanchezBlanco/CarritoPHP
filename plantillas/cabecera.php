<div class="container-fluid cabecera-contenido"> 
    <header class="container-fluid cabecera">
        
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <p class="cabecera-usuario"><b>Usuario:</b> <span><?php echo $_SESSION['usuario']['correo']?></span></p>        
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                <a class="btn btn-outline-secondary" href="categorias.php?categoria=3"><span>Home</span></a>
                <a class="btn btn-outline-secondary notificacionesCarrito" href="carrito.php"><span>Ver carrito</span>            
                    <?php
                        if (isset($_GET['contador'])) {
                            echo "<span class='badge'>".$_GET['contador']."</span>";
                        } else {
                            echo "";
                        }
                    ?>
                </a> 
                <a class="btn btn-outline-secondary" href="controlPHP/controlSessions/logout.php">Cerrar sesión</a>    
            </div>
        </div>
        
    </header>
</div>  