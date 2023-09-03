<?php


    session_start();
    
    if ( isset($_SESSION['active_status'])  ) {
            
        session_unset();
        session_destroy();
        echo " Tried to do something";
    }
    
        header("Location: ./index.php");
    

?>