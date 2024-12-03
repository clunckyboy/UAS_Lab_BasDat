<?php
   
   require "connection.php";

   $id = $_GET["id"];
   
   if (isset($_POST["submit"])){
      
      $name = $_POST["name"];
      $email = $_POST["email"];
      $role = $_POST["role"];
      
      $query = "UPDATE public.user
                  SET
                     name = '$name',
                     email = '$email',
                     role = '$role'
                  WHERE 
                     user_id = $id
               ";
      
      $result = pg_query($conn, $query);  
      
      if (!$result){
         die(pg_last_error());
      }

      header("location: user.php");
      exit;
   }
   

   $query = "SELECT 
                  name, 
                  email, 
                  role
               FROM 
                  public.user 
               WHERE 
                  user_id = $id"
            ;

   $result = pg_query($conn, $query);
   $user = pg_fetch_assoc($result);   
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registrasi Event</title>
   <style>
      td,th {
         padding: 10px;
         text-align: center;
      }
      
   </style>
</head>
<body>
   <a href="event.php">Halaman Event</a>
   <span> | </span>
   <a href="registrasi_event.php">Registrasi Event</a>

   <h1>Registrasi User</h1>
   <form action="update_user.php?id=<?= $id ?>" method="POST">
      <ul>
         <li>
               <label for="name">Nama : </label>
               <input type="text" name="name" required value="<?= $user["name"] ?>">
         </li>
         <li>
               <label for="email">E-mail : </label>
               <input type="email" name="email" required value="<?= $user["email"] ?>">
         </li>
         <li>
               <label for="role">Role : </label>
               <select name="role" required>
                  <option value="organizer" <?= $user["role"] == 'organizer' ? 'selected' : ''; ?>>Organizer</option>
                  <option value="participant" <?= $user["role"] == 'participant' ? 'selected' : ''; ?>>Participant</option>
               </select>
         </li>
         <li>
               <button type="submit" name="submit">Submit</button>
         </li>
      </ul>
   </form>
</body>   

