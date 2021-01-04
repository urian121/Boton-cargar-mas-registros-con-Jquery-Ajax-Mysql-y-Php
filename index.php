<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boton cargar mas registros con Ajax - Jquery - Mysql y Php</title>
    <link type="text/css" rel="shortcut icon" href="imgs/logo-mywebsite-urian-viera.svg"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
       <span class="navbar-brand">
          <img src="imgs/logo-mywebsite-urian-viera.svg" alt="Web Developer Urian Viera" width="120">
            Web Developer Urian Viera
      </span>
    </nav>

<br><br>
<br>  

<h3 class="text-center">Botón cargar más Registros, usando Ajax - Jquery - Mysql y Php</h3>


<div class="container" id="lista-comentarios">
    
<?php
require_once ('config.php');
$QueryComentarios      = ("SELECT * FROM comentarios ORDER BY id DESC LIMIT 5");
$resultadoComentarios  = mysqli_query($con, $QueryComentarios);
$total_registro        = mysqli_num_rows($resultadoComentarios);


if($total_registro >0){
while ($dataComentarios = mysqli_fetch_assoc($resultadoComentarios)) {
$idComentario = $dataComentarios['id'];  ?>

<div class="row border_special item-comentario">
    <div class="col-md-2 col-sm-12">
         <div id="imgperfil">
            <img src="fotosPerfil/<?php echo $dataComentarios['imagen'];?>" alt="">
        </div>
    </div> 

    <div class="col-md-10 text-center marb-35">
        <div class="contenidouser">
            <h4><?php echo $dataComentarios['titulo'];?></h4>
            <p><?php echo $dataComentarios['contenido'];?></p>
            <span><?php echo $dataComentarios['fecha'];?></span>
        </div>
    </div> 

</div>
    <?php } ?>
      <div class="show_more_main" id="show_more_main<?php echo $idComentario; ?>">

        <div class="row clearfix">
            <div class="col-sm-12 text-center">
                <button class="btn btn-danger btn-lg btn-block waves-effect show_more" type="submit" id="<?php echo $idComentario; ?>">Cargar Más Registros</button>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-sm-12 text-center">
                <span class="loding" style="display: none;"><img src="imgs/cargando_more.gif" alt="cargando"></span>
            </div>
        </div>

          
      </div>
    <?php } ?>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var id_inmueble = $(this).attr('id');
        var dataString = 'id=' + id_inmueble;
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'obteniendoMasDatos.php',
            data:dataString,
            success:function(html){
                $('#show_more_main'+id_inmueble).remove();
                $('#lista-comentarios').append(html);
            }
        });
    });
});
</script>

</body>
</html>
