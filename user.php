<?php

    require "connection.php";

    if (isset($_POST["submit"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $role = $_POST["role"];

        $query = "INSERT INTO 
                        public.user (
                            name, 
                            email, 
                            role
                        )
                    VALUES (
                            '$name', 
                            '$email',
                            '$role'
                            )"
                ;

        $result = pg_query($conn, $query);
        if (!$result) {
            echo "data gagal masuk : " . pg_last_error();
            die;
        }    
    }

    $query_users = "SELECT * 
                    FROM 
                        public.user 
                    ORDER BY 
                        join_date 
                    ASC";

    $result_users = pg_query($conn, $query_users);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <style>
        td,th {
            padding: 10px;
            text-align: center;
            width: 100vw;
        }
        
    </style>
</head>
<body>
    <a href="event.php">Halaman Event</a>
    <span> | </span>
    <a href="registrasi_event.php">Registrasi Event</a>

    <h1>Registrasi User</h1>
    <form action="user.php" method="POST">
        <ul>
            <li>
                <label for="name">Nama : </label>
                <input type="text" name="name" required>
            </li>
            <li>
                <label for="email">E-mail : </label>
                <input type="email" name="email" required>
            </li>
            <li>
                <label for="role">Role : </label>
                <select name="role" required>
                    <option value="" selected disabled>Pilih sebuah role</option>
                    <option value="organizer">Organizer</option>
                    <option value="participant">Participant</option>
                </select>
            </li>
            <li>
                <button type="submit" name="submit">Submit</button>
            </li>
        </ul>
    </form>

    <h1>Daftar User</h1>
    <table border="1" cellspacing="0">
        <tr>
            <th>User ID</th>
            <th>Action</th>
            <th>Name</th>
            <th>E-mail</th>
            <th>Role</th>
            <th>Join Date</th>
        </tr>

    <?php while ($user = pg_fetch_assoc($result_users)) : ?>
        <tr>
            <td><?= $user["user_id"]; ?></td>
            <td>
                <a href="update_user.php?id=<?= $user["user_id"]; ?>">Update</a> |
                <a href="delete_user.php?id=<?= $user["user_id"]; ?>">Delete</a>            
            </td>
            <td><?= $user["name"]; ?></td>
            <td><?= $user["email"]; ?></td>
            <td><?= $user["role"]; ?></td>
            <td><?= $user["join_date"]; ?></td>
        </tr>
    <?php endwhile; ?>    
        
        
    </table>
</body>
</html>