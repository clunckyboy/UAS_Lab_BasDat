<?php

   require "connection.php";
   
   if (!$_GET["id"]){
      header("location: user.php");
      exit;
   }

   $id = $_GET["id"];
   $query = "DELETE FROM 
                  public.user
               WHERE 
                  user_id = $id";
   $result = pg_query($conn, $query);

   if (!$result){
      die(pg_last_error());
   }

   header("location: user.php");
   exit;

?>