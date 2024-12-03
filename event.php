<?php

    require "connection.php";   
    
    if (isset($_POST["submit"])){
        $title = trim($_POST["title"]);
        $description = trim($_POST["description"]);
        $date = $_POST["date"];
        $location = trim($_POST["location"]);
        $organizer_id = $_POST["organizer_id"];

        $query = "INSERT INTO 
                    event (
                        organizer_id, 
                        title, 
                        description, 
                        date, 
                        location
                    )
                VALUES (
                    '$organizer_id', 
                    '$title',
                    '$description',
                    '$date',
                    '$location'
                )";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "data gagal masuk : " . pg_last_error();
            exit;
        }    
    }

    $query = "SELECT 
                user_id,
                name
            FROM 
                public.user 
            WHERE 
                role = 'organizer'
            ";
    
    $result = pg_query($conn, $query);   

    $query_event = "SELECT 
                        event_id,
                        name AS organizer,
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
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Page</title>
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
    <a href="registrasi_event.php">Registrasi Event</a>
    
    <h1>Tambahkan Event</h1>
    <form action="event.php" method="POST">
        <ul>
            <li>
                <label for="title">Title : </label>
                <input type="text" name="title" required>
            </li>
            <li style="align-items: start;">
                <label style="display: block;" for="description">description : </label>
                <textarea name="description" placeholder="Enter a description of the event " required cols="50" rows="10"></textarea>
            </li>
            <li>
               <label for="date">Date : </label>
               <input type="date" name="date" required>
            </li>
            <li>
               <label for="location">Location</label>
               <input type="text" name="location" required>
            </li>
            <li>
               <label for="organizer_id">Organizer</label>
               <select name="organizer_id" required>
                    <option value="" disabled selected>Choose an organizer</option>
                    <?php while ($user = pg_fetch_assoc($result)) : ?>   
                        <option value="<?= $user["user_id"] ?>"> <?= $user["name"]; ?> </option>
                    <?php endwhile; ?>
               </select>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>

    <h1>Daftar Event</h1>
    <table border="1" cellspacing="0">
        <tr>
            <th>Event ID</th>
            <th>Action</th>
            <th>Organizer</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Location</th>
        </tr>

        <?php while ($event = pg_fetch_assoc($result_event)) : ?>
            <tr>
                <td><?= $event["event_id"]; ?></td>
                <td>
                    <a href="update_event.php?id=<?= $event["event_id"]; ?>">Update</a> |
                    <a href="delete_event.php?id=<?= $event["event_id"]; ?>">Delete</a>            
                </td>
                <td><?= $event["organizer"]; ?></td>
                <td><?= $event["title"]; ?></td>
                <td>
                    <div class="scroll">
                        <?= $event["description"]; ?>
                    </div>
                </td>
                <td><?= $event["date"]; ?></td>
                <td><?= $event["location"]; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
</body>

</html>