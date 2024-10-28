<?php
    function customError($errno, $errstr)
    {
        echo "Error : [$errno] $errstr Terminando programa...";
        die();
    }

    set_error_handler("customError",E_USER_ERROR);
?>