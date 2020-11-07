<?php
session_start();
require_once 'connection.php';

    $disp = $conn->prepare('select * from dummy');
    $disp->execute();
    $res = $disp->fetchall(PDO::FETCH_OBJ);
    print_r($res);
   foreach ($res as $r)
   {
   echo "<li>".$r->number."</li>";
   }


?>
