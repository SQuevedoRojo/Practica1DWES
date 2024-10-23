<?php
    function customError($errno, $errstr)
    {
        echo "<script type='text/javascript'>";
        echo "window.alert('Error : [$errno] $errstr  <br> Terminando programa...')";
        echo "</script>";
        die();
    }

   

    set_error_handler("customError",E_USER_ERROR);
?>