<?php

    
    
    $dataBaseSource = "mysql:host=localhost; dbname=study";
    $username ="root";
    $password = "";
    

    try
    {
        $database = new PDO($dataBaseSource,$username,$password);
       
    }
    catch(PDOException $e)
    {
        $errorMessage = $e->getMessage();
        echo $errorMessage;
        exit();
    }

    
?>