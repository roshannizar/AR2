<?php
    session_start();

    if(session_destroy())
    {
        header('Location: AR2-LoginSplash.html');
    }
    else
    {
        echo "Server Error";
    }
?>