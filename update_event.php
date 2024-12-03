<?php
   
   require "connection.php";

   $id = $_GET["id"];
   
   if (isset($_POST["submit"])){
      
      $title = trim($_POST["title"]);
      $description = trim($_POST["description"]);
      $date = $_POST["date"];
      $location = trim($_POST["location"]);
      $organizer_id = $_POST["organizer_id"];

      $query = "UPDATE event 
                  SET
                     organizer_id = '$organizer_id',
                     title = '$title',
                     description = '$description',
                     date = '$date',
                     location = '$location'
                  WHERE 
                     event_id = $id
               ";                
      
      $result = pg_query($conn, $query);  
      
      if (!$result){
         die(pg_last_error());
      }

      header("location: event.php");
      exit;
   }
   
   $query_event = "SELECT 
                        event_id,
                        title,
                        description,
                        date,
                        location
                    FROM 
                        event e , 
                        public.user u
                    WHERE
                        e.organizer_id = u.user_id";

   $result_event = pg_query($conn, $query_event);
   $event = pg_fetch_assoc($result_event);

   $query_org = "SELECT 
                  user_id,
                  name,
                  role,
                  organizer_id
               FROM 
                  public.user u,
                  event e
               WHERE 
                  role = 'organizer'
               ";
    
   $result = pg_query($conn, $query_org);   
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ubah Event</title>
   <style>
      td,th {
         padding: 10px;
         text-align: center;
      }
      
   </style>
</head>
<body>
   <a href="user.php">Halaman User</a>
   <span> | </span>
   <a href="registrasi_event.php">Registrasi Event</a>

   <h1>Ubah Event</h1>
   <form action="update_event.php?id=<?= $id ?>" method="POST">
      <ul>
            <li>
                <label for="title">Title : </label>
                <input type="text" name="title" required value="<?= $event["title"] ?>">
            </li>
            <li style="align-items: start;">
                <label style="display: block;" for="description">description : </label>
                <textarea name="description" placeholder="Enter a description of the event " required cols="50" rows="10">
                  <?= $event["description"] ?>
                </textarea>
            </li>
            <li>
               <label for="date">Date : </label>
               <input type="date" name="date" required value="<?= $event["date"] ?>">
            </li>
            <li>
               <label for="location">Location</label>
               <input type="text" name="location" required value="<?= $event["location"] ?>">
            </li>
            <li>
               <label for="organizer_id">Organizer</label>
               <select name="organizer_id" required>
                    <?php while ($organizer = pg_fetch_assoc($result)) : ?>   
                        <option value="<?= $organizer["user_id"] ?>" <?= $organizer["user_id"] == $organizer["organizer_id"] ? 'selected' : ''; ?> >
                            <?= $organizer["name"]; ?> 
                        </option>
                    <?php endwhile; ?>
               </select>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
      </ul>
   </form>
</body>   

