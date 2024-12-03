<?php

   if (!$_GET["id"]){
      header("location: registrasi_event.php");
      exit;
   }

   require "connection.php";

   $id = $_GET["id"];
   $tabel = '"public"."eventRegistration"';
   
   if (isset($_POST["submit"])){
      
      $status = $_POST["status"];
      
      $query = "UPDATE $tabel
                  SET
                     status = '$status'
                  WHERE 
                     registration_id = $id
               ";
      
      $result = pg_query($conn, $query);  
      
      if (!$result){
         die(pg_last_error());
      }

      header("location: registrasi_event.php");
      exit;
   }
   
   $event_query = "SELECT
                        event.title,
                        $tabel.event_id
                     FROM 
                        event,
                        $tabel
                     WHERE 
                        $tabel.event_id = event.event_id 
                ";

   $event_result = pg_query($conn, $event_query);
   $event = pg_fetch_array($event_result);


   $user_query = "SELECT
                        $tabel.user_id, 
                        public.user.name
                  FROM
                        public.user,
                        $tabel
                  WHERE 
                        $tabel.user_id = public.user.user_id
                  ";

   $user_result = pg_query($conn, $user_query);
   $user = pg_fetch_array($user_result);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        td,th {
            padding: 10px;
            text-align: center;
            width: 100vw;
        }

        .scroll{
            overflow-y: scroll;
            max-height: 70px;
            text-align: start;
        }
        
    </style>
</head>

<body>
    <a href="user.php">Halaman User</a>
    <span> | </span>
    <a href="event.php">Halaman Event</a>
    
    <h1>Registrasi</h1>

    <ul>
      <li>
         <label for="event_id">Event Title : </label>
         <input type="text" value="<?= $event["title"]; ?>" disabled>
      </li>
      <li>
         <label for="user_id">User Name : </label>
         <input type="text" value="<?= $user["name"]; ?>" disabled>
      </li>
      
      <form action="" method="POST">
      <li>
         <label for="status">Status : </label>
         <select name="status" id="" required>
            <option value="" selected disabled>Make A Status</option>
            <option value="confirmed">Confirmed</option>
            <option value="pending">Pending</option>  
            <option value="canceled">Canceled</option>
         </select>
      </li>
      <li>
         <button type="submit" name="submit">Submit</button>
      </li>
      </form>
    </ul>


</body>
</html>