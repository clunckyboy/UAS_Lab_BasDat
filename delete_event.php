<?php

   require "connection.php";
   
   if (!$_GET["id"]){
      header("location: event.php");
      exit;
   }

   $id = $_GET["id"];
   $query = "DELETE FROM 
                  event
               WHERE 
                  event_id = $id"
            ;
   $result = pg_query($conn, $query);

   if (!$result){
      die(pg_last_error());
   }

   header("location: event.php");
   exit;

?>