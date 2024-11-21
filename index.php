<HTML>

<HEAD> 
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>JUEGO DADOS - PRÁCTICA OBLIGATORIA</title>
    <link rel="stylesheet" href="./bootstrap.min.css">
  </head>

</HEAD>
  <?php 
    include_once 'funciones_p01_dados.php';
    include_once 'funcion_error.php';
  ?>
<BODY>

<form name='juegodados' action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> method='post'>

<div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header"><B>JUEGO DADOS</B> </div>
		<div class="card-body">



 
<B>Nombre : </B><input type='text' name='nombre' value='' size=25><br><br> 
<B>Apellidos : </B><input type='text' name='apellido' value='' size=25><br><br> 
<B>Email : </B><input type='text' name='email' value='' size=25><br><br> 

<B>Pulsa para Registrar al Jugador: </B>
  <div>
    <input type="submit" value="Registrar Usuario" name="registrar" class="btn btn-warning disabled">
  </div>	



<?php
/*
 * Registros de los jugadores
 */
  if((($_SERVER["REQUEST_METHOD"] == "POST")))
  {
    $jugador = recogerjugador();
    annadirjugador($jugador);
  }
?>



</FORM>

</BODY>

</HTML>