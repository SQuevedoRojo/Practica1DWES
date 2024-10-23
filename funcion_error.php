<?php
    function customError($errno, $errstr)
    {
        echo "<script type='text/javascript'>";
        echo "alert(Error : [$errno] $errstr <br> Terminando programa...)";
        echo "</script>";
        die();
    }

    function customWarning($errno, $errstr)
    {
        echo "<script type='text/javascript'>";
        echo "alert(Warning : [$errno] $errstr <br>)";
        echo "</script>";
    }

    set_error_handler("customError",E_USER_ERROR);
    set_error_handler("customWarning",E_USER_WARNING);
?>