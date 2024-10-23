<?php
inicio();

function inicio(){
    $jugadores = compJugadores();
    $numdados = compNumDados();
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
    if($jugadores<2)
        trigger_error("Numero de jugadores invalido", E_USER_ERROR);
    else
        return $jugadores;
}

function compNumDados(){
    $numdados=0;
    if ($_REQUEST["numdados"]<1 || $_REQUEST["numdados"]>10) {
        trigger_error($_REQUEST["numdados"] > 10 ? "Numero superior a 10" : "Numero inferior a 1", E_USER_WARNING);
        $numdados=$_REQUEST["numdados"]>10?10:1;
    }else
        $numdados=$_REQUEST["numdados"];
    return $numdados;
}


?>