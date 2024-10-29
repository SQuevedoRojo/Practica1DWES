<?php
/*
    Funcion que comprueba el numero de jugadores existentes, si hay menos de dos jugadores se termina el programa por una excepcion
    */
    function compJugadores(){
        $jugadores = array();
        $jugadoresFichero = file("jugadores.txt");
        $cont = 0;
        while ($cont < count($jugadoresFichero)) {
            $nom = explode($jugadoresFichero[$cont],'#');
            $jugadores[$nom[0]] = array();
            $cont++;
        }
        if(count($jugadores)<1)
            trigger_error("Numero de jugadores invalido", E_USER_ERROR);
        else
            return $jugadores;
    }

    /*
    Funcion que comprueba el numero de dados, si es menor a 1 o mayor a 10 se termina el programa por una excepcion
    */
    function compNumDados(){
        $numdados=0;
        if ($_REQUEST["numdados"]<1 || $_REQUEST["numdados"]>10) {
            trigger_error($_REQUEST["numdados"] > 10 ? "Numero superior a 10" : "Numero inferior a 1", E_USER_ERROR);
        }else
            $numdados=$_REQUEST["numdados"];
        return $numdados;
    }

    /*
    Funcion que genera los dados de los jugadores segun los dados introducidos por el usuario.
    Recibe el numero de dados y la estructura de los jugadores existentes
    Deuelve un array con la estructura de los jugadores con la puntuacion total y el array de los jugadores con los dados generados
    */
    function sumaDadosJugadores($dados,&$jugadores)
    {
        $puntuacionesJugadores = array();
        
        foreach ($jugadores as $jugador => &$valor) 
        {
            for ($i=0; $i < $dados; $i++) 
            { 
                $valor[$i] = rand(1,6);
            }
            $puntuacionesJugadores[$jugador] = array_sum($valor);
        }
        if ($dados > 2)
            $puntuacionesJugadores = comprobarSiLosDadosSonIguales($jugadores,$puntuacionesJugadores);
        return $puntuacionesJugadores;
    }


    /*
    Funcion que comprueba si los dados en los jugadores son iguales, cuando los dados sean mas de dos
    Recibe la estructura de los jugadores y la puntuacion de los jugadores para cambiar el valor a 100 si los dados son iguales
    Devuelve el array de puntuacion de los jugadores
    */
    function comprobarSiLosDadosSonIguales(&$jugadores,$puntuacionesJugadores)
    {
		foreach ($jugadores as $jugador => &$valor) 
        {
            $todosIguales = true;
            $valor1 = $valor[0];
            $indice = 1;
            while($indice < count($valor) && $todosIguales) 
            { 
                if($valor1 == $valor[$indice])
                    $todosIguales = true;
                else
                    $todosIguales = false;
                $indice += 1;
            }
            if($todosIguales)
                $puntuacionesJugadores[$jugador] = 100;
        }
        return $puntuacionesJugadores;
    }

    /*
    Funcion que imprime la tabla de los dados de cada jugador.
    Recibe el array de jugadores que contiene los dados de cada uno
    */
    function imprimirTabla(&$jugadores)
    {
        print "<br><br>";
		print "<h2><strong>RESULTADO JUEGO DADOS</strong><h2>";
        print "<table border='1'>";
        foreach($jugadores as $jugador => &$valores)
        {
            print "<tr><th>". strtoupper($jugador) ."</th>";
            foreach($valores as $valor)
            {
                print "<th><img src='images/".($valor.".PNG'") ." width='45px' heigth='45px'/></th>";
            }
            print "</tr>";
        }
        print "</table>";
    }


    /*
    Funcion que recibe el array de puntuacionesJugadores e imprime la puntuacion de cada jugador
    */
    function imprimirPuntuacionesJugadores($puntuacionesJugadores)
    {
        print "<br>";
        foreach ($puntuacionesJugadores as $jugador => &$valor) {
            print "<h4><strong>". $jugador ."</strong> | Puntuacion -> ". $valor ."</h4>";
        }
    }


    /*
    Funcion que recibe la puntuacion de los jugadores y calcula los ganadores
    Devuelve un array que contiene los ganadores de la partida
    */
    function saberGanador(&$puntuacionesJugadores)
    {
        $ganadores = array();
        $valorMaximo = max($puntuacionesJugadores);
        foreach ($puntuacionesJugadores as $jugador => $valor) {
            if($valor == $valorMaximo)
                $ganadores[$jugador] = $valor;     
        }
        return $ganadores;
    }
    
    /*
    Funcion que recibe el array de ganadores e imprime los nombres de los jugadores
    */
    function imprimirGanador(&$ganadores)
    {
        print "<br>";
        foreach ($ganadores as $jugador => $valor) {
            print "<h4><strong>Ganador -> </strong>" . $jugador ."</h4>";
        }
    }

    /*
    Funcion que recibe el array de ganadores e imprime la puntuacion de los ganadores
    */
    function imprimirNumeroGanadores(&$ganadores)
    {
        print "<br>";
        print "<h4><strong>Numero Ganadores -> </strong>" . count($ganadores) . "</h4>";
    }

    function recogerjugador()
    {
        $nombre = limpiarDatos($_REQUEST['nombre']);
        $apellido= limpiarDatos($_REQUEST['apellido']);
        $email= limpiarDatos($_REQUEST['email']);
        return $nombre . "#" . $apellido . "#" . $email . "\n";
    }

    function limpiarDatos($data){
        $data = trim($data);
        return $data;
    }

    function annadirJugador($cadena)
    {
        $file = fopen("jugadores.txt","a");
        fwrite($file,$cadena);
        fclose($file);
    }
?>