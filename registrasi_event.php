<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>

<body>
    <a href="user.php">Halaman User</a>
    <span> | </span>
    <a href="event.php">Halaman Event</a>
    
    <h1>Registrasi</h1>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="event_id">Event name : </label>
                <select name="event_id" required>
                  <option value=""></option>
                </select>
            </li>
            <li>
                <label for="user_id">User Name : </label>
                <select name="user_id" required>
                  <option value=""></option>
                </select>
            </li>
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
                <button type="submit">Submit</button>
            </li>
        </ul>
    </form>

    <h1>Daftar User</h1>
    <table border="1" cellspacing="0">
        <tr>
            <th>Registration ID</th>
            <th>Action</th>
            <th>User Name</th>
            <th>Event Name</th>
            <th>Registration Date</th>
            <th>Status</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach($data as $row) : ?>
            <tr>
                <td><?= $row[""] ?></td>
                <td>
                    <!-- <a href="" style="color: blue;">Ubah</a> | -->
                    <a href="./logic/hapus.php?id=<?=$row["user_id"];?>" onclick="return confirm('Yakin untuk menghapus data ini ?')" style="color: red;">Hapus</a>          
                </td>
                <td><img src="./user_pp/<?= $row["profile_photo"]; ?>" width="60px"></td>
                <td><?= $row["username"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["goal"]; ?></td>
            </tr>
        <?php $i++; ?>
        <?php endforeach;  ?>
    </table>
</body>

</html>