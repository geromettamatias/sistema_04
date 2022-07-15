<?php
session_start();
unset($_SESSION["s_usuario"]);
session_destroy();


echo 'si';

;
?>