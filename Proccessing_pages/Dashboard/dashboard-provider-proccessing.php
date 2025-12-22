<?php

session_start();

require_once ("../../includes/db/database.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    var_dump($_POST);

}

?>