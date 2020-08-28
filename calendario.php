<?php	include_once 'includes/Templetes/header.php';?>


    <section class="seccion contenedor">
    <h2>Calendario de Eventos</h2>
    
    <?php  
        //abrir conexion a BD
        try{
            require_once('includes/Funciones/bd_conexion.php');
            $sql = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` "; //seleccionar campo de eventos pero con las llaves de las tablas de categoria e invitados
            $sql .= "FROM `eventos`";
            $sql .= "INNER JOIN `categoria_evento`";
            $sql .= "ON `eventos`.`id_cat_evento` = `categoria_evento`.`id_categoria`"; //uniendo las tablas con JOIN y ON, id_cat_eventos esta en eventos, y id_categoria en categoria_evento
            $sql .= "INNER JOIN `invitados`";
            $sql .= "ON eventos.id_inv = `invitados`.`invitado_id`"; //Segunda union de la tabla de invitados con la tabla eventos
            $sql .= "ORDER BY `evento_id`";
            $resultado = $conn -> query($sql); //variable que almacena la solicitud y solo es un query

        } catch(\Exception $e){
            echo $e->getMessage(); //`por si hay error
        } 
    ?>
    <div class="calendario">
        <?php 
            $calendario = array();
             
            while($eventos =  $resultado->fetch_assoc()){
            //Obtiene la fecha del evento
            $fecha =  $eventos['fecha_evento']; 
            
            $evento = array(
                'titulo' => $eventos['nombre_evento'],
                'fecha' => $eventos['fecha_evento'],
                'hora' => $eventos['hora_evento'],
                'categoria' => $eventos['cat_evento'],
                'icono' => "fa". " ". $eventos['icono'],
                'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
            );
            
            $calendario[$fecha][] = $evento;
                
            ?> 
           
            
        
        <?php  } //while  ?>


        <?php	//imprime todos los eventos
            foreach($calendario as $dia => $lista_eventos){?>
            <h4>
                <i class="fa fa-calendar"></i>
                <?php	//UNIX para fecha a español
                        setlocale(LC_TIME, 'es_ES.UTF-8');
                        //Windows para fecha a español
                        setlocale (LC_TIME, 'spanish');
                ?>
                <?php	echo strftime("%A, %d de %B del %Y", strtotime($dia));?>
                
            </h4>

            <?php	foreach($lista_eventos as $evento){?>
            <div class="dia clearfix" >
                <p class="titulo">
                    <?php	echo $evento['titulo'];?>
                </p>
                <p class="hora">
                    <i class="fa fa-clock-o" aria-hidden = "true"></i>
                    <?php	echo $evento['hora'] . " " . $evento['fecha'];?>
                </p>
                <p class="categoria">
                <i class="<?php	 echo $evento['icono'];?>" aria-hidden = "true"></i>
                    <?php	echo $evento['categoria'];?>
                </p>
                <p class="invitado">
                <i class="fa fa-user" aria-hidden = "true"></i>
                    <?php	echo $evento['invitado'];?>
                </p>

                
            </div>
            
            <?php	}//foreach $lista_eventos ?>
            
        
        
        <?php	} //foreach $calendario?>
        
        
        
    </div>

    <?php	$conn->close(); //Cerrar BD?>

    </section>


    
    <h2>Mapa del Evento</h2> 
    <div class="mapa" id="mapa" ></div>





<?php	include_once 'includes/Templetes/footer.php';?>