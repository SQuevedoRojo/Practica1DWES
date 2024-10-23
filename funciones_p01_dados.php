<?php

    function inicio(){
        $jugadores = compJugadores();
        $numdados = compNumDados();
        sumaDadosJugadores($numdados,$jugadores);
    }

    function compJugadores(){
        $jugadores = array();
        $cont = 1;
        while ($cont < 5) {
            $nom = "jug" . $cont;
            if ($_REQUEST[$nom] != '')
                $jugadores[$_REQUEST[$nom]] = array();
            $cont++;
        }
        if(count($jugadores)<2)
            trigger_error("Numero de jugadores invalido", E_USER_ERROR);
        else
            return $jugadores;
    }

    function compNumDados(){
        $numdados=0;
        if ($_REQUEST["numdados"]<1 || $_REQUEST["numdados"]>10) {
            trigger_error($_REQUEST["numdados"] > 10 ? "Numero superior a 10" : "Numero inferior a 1", E_USER_ERROR);
        }else
            $numdados=$_REQUEST["numdados"];
        return $numdados;
    }

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
        if ($dados > 1)
            $puntuacionesJugadores = comprobarSiLosDadosSonIguales($jugadores,$puntuacionesJugadores);
        imprimirTabla($jugadores);
        imprimirPuntuacionesJugadores($puntuacionesJugadores);
        saberGanador($puntuacionesJugadores);
    }

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
            }
            if($todosIguales)
                $puntuacionesJugadores[$jugador] = 100;
        }
        return $puntuacionesJugadores;
    }

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

    function imprimirPuntuacionesJugadores($puntuacionesJugadores)
    {
        print "<br>";
        foreach ($puntuacionesJugadores as $jugador => &$valor) {
            print "<h4><strong>". $jugador ."</strong> | Puntuacion -> ". $valor ."</h4>";
        }
    }

    function saberGanador(&$puntuacionesJugadores)
    {
        $ganadores = array();
        $valorMaximo = max($puntuacionesJugadores);
        foreach ($puntuacionesJugadores as $jugador => $valor) {
            if($valor == $valorMaximo)
                $ganadores[$jugador] = $valor;     
        }
        imprimirGanador($ganadores);
        imprimirNumeroGanadores($ganadores);
    }
    

    function imprimirGanador(&$ganadores)
    {
        print "<br>";
        foreach ($ganadores as $jugador => $valor) {
            print "<h4><strong>Ganador -> </strong>" . $jugador ."</h4>";
        }
    }

    function imprimirNumeroGanadores(&$ganadores)
    {
        print "<br>";
        print "<h4><strong>Numero Ganadores -> </strong>" . count($ganadores) . "</h4>";
    }
?>