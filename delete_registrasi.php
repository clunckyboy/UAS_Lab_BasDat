<?php

   require "connection.php";
   
   if (!$_GET["id"]){
      header("location: registrasi_event.php");
      exit;
   }

   $table = '"public"."eventRegistration"';

   $id = $_GET["id"];
   $query = "DELETE FROM 
                  $table
               WHERE 
                  registration_id = $id";

   $result = pg_query($conn, $query);

   if (!$result){
      die(pg_last_error());
   }

   header("location: registrasi_event.php");
   exit;

?>