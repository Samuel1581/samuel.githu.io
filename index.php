    <?php	include_once 'includes/Templetes/header.php';?>

    <section class="seccion contenedor">
        <h2>La Mejor Conferecia de Diseño Web en Español</h2>
        <p>Pellentesque ut dictum nunc. Sed iaculis felis quam, sed dapibus nisi aliquam a. Vivamus egestas lectus risus. Curabitur consequat, turpis a facilisis tincidunt, tortor enim convallis ligula, a dictum magna felis non nisl. Nulla vestibulum diam
            eros, sit amet iaculis magna cursus non. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </section>

    <section class="programa">
        <div class="contenedor-video">
            <video autoplay loop poster="img/bg-talleres.jpg">
              <source src="video/video.mp4" type="video/mp4">
              <source src="video/video.webm" type="video/webm">
              <source src="video/video.ogv" type="video/ogv">
            </video>
        </div>

        <!--contendor-video-->
        <div class="contenido-programa">
            <div class="contenedor">
                <div class="programa-evento">
                    <h2>Programa del evento</h2>    
                    <?php  
                        //abrir conexion a BD
                        try{
                            require_once('includes/Funciones/bd_conexion.php');
                            $sql = "SELECT * FROM `categoria_evento`"; 
                            $resultado = $conn -> query($sql); //variable que almacena la solicitud

                        } catch(\Exception $e){
                        echo $e->getMessage(); //`por si hay error
                        } 
                    ?>
                    <nav class="menu-programa">
                        <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)){ ?>
                            <?php $categoria = $cat['cat_evento']; ?>
                                <a href="#<?php echo strtolower($categoria)?>">
                                <i class="fa <?php echo $cat['icono'];?>"></i><?php echo $categoria ?></a>
                            <?php }//Fin while $cat?>
                    </nav>
                    <?php  
                        //abrir conexion a BD
                        try {
                            require_once 'includes/Funciones/bd_conexion.php';
                            $sql = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, 
                            `hora_evento`, `cat_evento`, `icono`, 
                            `nombre_invitado`, `apellido_invitado`"; //seleccionar campo de eventos pero con las llaves de las tablas de categoria e invitados
                            $sql .= "FROM `eventos`";
                            $sql .= "INNER JOIN `categoria_evento`";
                            $sql .= "ON eventos.`id_cat_evento` = `categoria_evento`.`id_categoria`"; //uniendo las tablas con JOIN y ON, id_cat_eventos esta en eventos, y id_categoria en categoria_evento
                            $sql .= "INNER JOIN `invitados`";
                            $sql .= "ON eventos.id_inv = `invitados`.`invitado_id`"; //Segunda union de la tabla de invitados con la tabla eventos
                            $sql .= "AND `eventos`.`id_cat_evento` = 1 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                            $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, 
                            `hora_evento`, `cat_evento`, `icono`, 
                            `nombre_invitado`, `apellido_invitado`"; //seleccionar campo de eventos pero con las llaves de las tablas de categoria e invitados
                            $sql .= "FROM `eventos`";
                            $sql .= "INNER JOIN `categoria_evento`";
                            $sql .= "ON eventos.`id_cat_evento` = `categoria_evento`.`id_categoria`"; //uniendo las tablas con JOIN y ON, id_cat_eventos esta en eventos, y id_categoria en categoria_evento
                            $sql .= "INNER JOIN `invitados`";
                            $sql .= "ON eventos.id_inv = `invitados`.`invitado_id`"; //Segunda union de la tabla de invitados con la tabla eventos
                            $sql .= "AND `eventos`.`id_cat_evento` = 2 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                            $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, 
                            `hora_evento`, `cat_evento`, `icono`, 
                            `nombre_invitado`, `apellido_invitado`"; //seleccionar campo de eventos pero con las llaves de las tablas de categoria e invitados
                            $sql .= "FROM `eventos`";
                            $sql .= "INNER JOIN `categoria_evento`";
                            $sql .= "ON eventos.`id_cat_evento` = `categoria_evento`.`id_categoria`"; //uniendo las tablas con JOIN y ON, id_cat_eventos esta en eventos, y id_categoria en categoria_evento
                            $sql .= "INNER JOIN `invitados`";
                            $sql .= "ON eventos.id_inv = `invitados`.`invitado_id`"; //Segunda union de la tabla de invitados con la tabla eventos
                            $sql .= "AND `eventos`.`id_cat_evento` = 3 ";
                            $sql .= "ORDER BY `evento_id` LIMIT 2;";
                        } catch (\Exception $e) {
                                echo $e->getMessage(); //por si hay error
                        }   
                    ?>
                    <?php //$eventos = $resultado->fetch_assoc(); ?>

                    
                    <?php $conn->multi_query($sql); //multiquerys ?>
                     <?php do{ 
                        $resultado = $conn->store_result();
                        $row = $resultado->fetch_all(MYSQLI_ASSOC); //$row es un array?>

                        <?php $i = 0; ?>
                        <?php foreach($row as $evento): ?>
                            <?php if($i % 2 == 0){ ?>
                            <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                            <?php } ?>
                                <div class="detalle-evento">
                                    <h3><?php echo ($evento['nombre_evento']); ?></h3>
                                        <p><i class="fa fa-clock" aria-hidden = "true"></i><?php echo $evento['hora_evento']; ?></p>
                                        <p><i class="fa fa-calendar" aria-hidden = "true"></i> <?php echo $evento['fecha_evento']; ?></p>
                                        <p><i class="fa fa-user" aria-hidden = "true"></i> <?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></p>
                                </div>
                                <!--detalle-evento-->
                                
                            <?php if($i % 2 == 1){ ?>
                                <a href="calendario.php" class="boton float-r">Ver todos</a>
                                </div>
                                <!--info-cusrso-->
                            <?php } ?>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        <?php $resultado->free(); ?>
                    <?php }while($conn->more_results() && $conn->next_result()); ?>


                    

                    

                </div>
                <!--programa-evento-->
            </div>
            <!--contenedor-->
        </div>
        <!--contenido-programa-->

    </section>


    <?php include_once 'includes/Templetes/invitados.php';?>


    <div class="contador parallax">
        <div class="contenedor">
            <ul class="resumen-evento clearfix">
                <li>
                    <p class="numero"></p> Invitados</li>
                <li>
                    <p class="numero"></p> Días</li>
                <li>
                    <p class="numero"></p> Talleres</li>
                <li>
                    <p class="numero"></p> Conferencias </li>
            </ul>
        </div>
    </div>

    <section class="precios seccion">
        <h2>Precios</h2>
        <div class="contenedor">
            <ul class="lista-precios clearfix">
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por día</h3>
                        <p class="numero">$30</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las Conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="reservaciones.php" class="boton hollow">Comprar</a>
                    </div>
                </li>

                <li>
                    <div class="tabla-precio">
                        <h3>Todos los días</h3>
                        <p class="numero">$50</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las Conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="reservaciones.php" class="boton">Comprar</a>
                    </div>
                </li>

                <li>
                    <div class="tabla-precio">
                        <h3>Pase por dos días</h3>
                        <p class="numero">$40</p>
                        <ul>
                            <li>Bocadillos Gratis</li>
                            <li>Todas las Conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <a href="reservaciones.php" class="boton hollow">Comprar</a>
                    </div>
                </li>
            </ul>
        </div>

    </section>

    <div class="mapa" id="mapa"></div>



    <section class="seccion">
        <h2>Testimoniales</h2>
        <div class="testimoniales contenedor clearfix">
            <div class="testimonial clearfix">
                <blockquote class="clearfix">
                    <p>Pellentesque ut dictum nunc. Sed iaculis felis quam, sed dapibus nisi aliquam a. Vivamus egestas lectus risus. Curabitur consequat, turpis a facilisis tincidunt, tortor enim convallis ligula, a dictum magna felis non nisl. </p>
                    <footer class="clearfix info-testimonial">
                        <img src="img/testimonial.jpg" alt="testimonial">
                        <cite>Osvaldo De Mazatlan <span>diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--testimonial-->
            <div class="testimonial clearfix">
                <blockquote>
                    <p>Pellentesque ut dictum nunc. Sed iaculis felis quam, sed dapibus nisi aliquam a. Vivamus egestas lectus risus. Curabitur consequat, turpis a facilisis tincidunt, tortor enim convallis ligula, a dictum magna felis non nisl. </p>
                    <footer class="clearfix info-testimonial">
                        <img src="img/testimonial.jpg" alt="testimonial">
                        <cite>Osvaldo De Mazatlan <span>diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--testimonial-->
            <div class="testimonial clearfix">
                <blockquote>
                    <p>Pellentesque ut dictum nunc. Sed iaculis felis quam, sed dapibus nisi aliquam a. Vivamus egestas lectus risus. Curabitur consequat, turpis a facilisis tincidunt, tortor enim convallis ligula, a dictum magna felis non nisl. </p>
                    <footer class="clearfix info-testimonial">
                        <img src="img/testimonial.jpg" alt="testimonial">
                        <cite>Osvaldo <span>diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--testimonial-->
        </div>
        <!--testimoniales-->
    </section>

    <div class="newsletter parallax">
        <div class="contenido contenedor">
            <p>Registrate al Newsletter: </p>
            <h3>GDLWebCamp</h3>
            <a href="#" class="boton transparente">Registro</a>
        </div>
        <!--contenido-->
    </div>
    <!--newsletter-->

    <section class="seccion">
        <h2>Faltan</h2>
        <div class="cuenta-regresiva contenedor">
            <ul>
                <li>
                    <p id="dias" class="numero "></p> Días</li>
                <li>
                    <p id="horas" class="numero "></p> Horas</li>
                <li>
                    <p id="minutos" class="numero "></p> Mnutos</li>
                <li>
                    <p id="segundos" class="numero "></p> Segundos</li>
            </ul>
        </div>
        <!--cuenta regresiva-->
    </section>

    <?php	include_once 'includes/Templetes/footer.php';?>