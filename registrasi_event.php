<?php

    require "connection.php";

    $tabel = '"public"."eventRegistration"';

    if (isset($_POST["submit"])){
        $user_id = $_POST["user_id"];
        $event_id = $_POST["event_id"];
        $status = $_POST["status"];

        $query = "INSERT INTO 
                    $tabel (
                        user_id, 
                        event_id, 
                        status 
                    )
                VALUES (
                    '$user_id', 
                    '$event_id',
                    '$status'
                )";

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "data gagal masuk : " . pg_last_error();
            exit;
        }    
    }

    $event_query = "SELECT
                        title,
                        event_id
                    FROM 
                        event
                ";

    $event_result = pg_query($conn, $event_query);


    $user_query = "SELECT
                        user_id, 
                        name
                    FROM
                        public.user";

    $user_result = pg_query($conn, $user_query);

    $daftar_query = "SELECT 
                        registration_id,
                        title,
                        name,
                        registration_date,
                        status
                    FROM 
                        $tabel r,
                        event e,
                        public.user u
                    WHERE  
                        r.user_id = u.user_id AND
                        e.event_id = r.event_id
                    ";

    $daftar_result = pg_query($conn, $daftar_query);


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

    <form action="" method="POST">
        <ul>
            <li>
                <label for="event_id">Event Title : </label>
                <select name="event_id" required>
                  <?php while ($event = pg_fetch_assoc($event_result)) : ?>
                    <option value="<?= $event['event_id']; ?>"> <?= $event["title"];  ?> </option>
                  <?php endwhile; ?>
                </select>
            </li>
            <li>
                <label for="user_id">User Name : </label>
                <select name="user_id" required>
                  <?php while ($user = pg_fetch_assoc($user_result)) : ?>  
                    <option value="<?= $user["user_id"]; ?>"> <?= $user["name"]; ?> </option>
                  <?php endwhile; ?> 
                </select>
            </li>
            <li>
               <label for="status">Status : </label>
               <select name="status" id="" required>
                  <option value="" selected disabled>Make A Status</option>
                  <option value="confirmed">Confirmed</option>
                  <option value="pending">Pending</option>  
               </select>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>

    <h1>Daftar Registrasi</h1>
    <table border="1" cellspacing="0">
        <tr>
            <th>Registration ID</th>
            <th>Action</th>
            <th>Event Title</th>
            <th>User Name</th>
            <th>Registration Date</th>
            <th>Status</th>
        </tr>

        
        <?php while($registrasi = pg_fetch_assoc($daftar_result)) : ?>
        <tr>
            <td><?= $registrasi["registration_id"]; ?></td>
            <td>
                <a href="update_registrasi.php?id=<?= $registrasi["registration_id"]; ?>">Update</a> |
                <a href="delete_registrasi.php?id=<?= $registrasi["registration_id"]; ?>">Delete</a>   
            </td>
            <td><?= $registrasi["title"]; ?></td>
            <td><?= $registrasi["name"]; ?></td>
            <td><?= $registrasi["registration_id"]; ?></td>
            <td><?= $registrasi["status"]; ?></td>
        </tr>    
        <?php endwhile;  ?>

    </table>
</body>
</html>