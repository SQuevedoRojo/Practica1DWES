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

<B>Numero Dados: <input type='text' name='numdados' value='' size=5><br><br>


<B>Pulsa para Tirar Dados: 

<div>
	<input type="submit" value="Tirar Dados" name="tirar" class="btn btn-warning disabled">
</div>	


<?php
  /*
  * Inicio del programa
  */
  if(($_SERVER["REQUEST_METHOD"] == "POST")){
      $numdados = compNumDados();
      $jugadores = compJugadores();
      $puntuacionesJugadores = sumaDadosJugadores($numdados,$jugadores);
      imprimirTabla($jugadores);
      imprimirPuntuacionesJugadores($puntuacionesJugadores);
      $ganadores = saberGanador($puntuacionesJugadores);
      imprimirGanador($ganadores);
      imprimirNumeroGanadores($ganadores);
  }
?>



</FORM>

</BODY>

</HTML>