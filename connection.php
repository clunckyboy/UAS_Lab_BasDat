<?php
   
   $conn = pg_connect("
            host=localhost
            port=5432
            dbname=eventManagement
            user=postgres
            password=Zingzing@1"
         );

   if (!$conn) {
      die(pg_last_error());
   }
?>