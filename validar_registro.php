<?php if(isset($_POST['submit'])){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $regalo = $_POST['regalo'];
            $total = $_POST['total_pedido']; 
            $fecha = date('Y-m-d H:i:s');
            //Pedidos
            $boletos= $_POST['boletos'];
            $camisas = $_POST['pedido_camisas'];
            $etiquetas = $_POST['pedido_etiquetas'];
            include_once 'includes/Funciones/funciones.php';
            $pedido = productos_json($boletos, $camisas, $etiquetas);
            //eventos
            $eventos = $_POST['registro'];
            $registro = eventos_json($eventos);
            try{
                require_once('includes/Funciones/bd_conexion.php');
                $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, 
                fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
                $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total); //pepared statements
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header('Location: validar_registro.php?exitoso=1');
            } catch(\Exception $e){
                echo $e->getMessage(); //por si hay error
            } 
     ?>
<?php } ?>

<?php	include_once 'includes/Templetes/header.php';?>
    
    <section class="seccion contenedor">
        <h2>Resumen de tu registro</h2>
        <?php if(isset($_GET['exitoso'])){ ?>
            
            <?php  if($_GET['exitoso'] == "1"){?> 
             <h4>Registro Exitoso</h4>
             
            <?php } ?>
        <?php } ?>  
        
    </section>

    <h2>Mapa del Evento</h2>    
    <div class="mapa" id="mapa"></div>

<?php	include_once 'includes/Templetes/footer.php';?>