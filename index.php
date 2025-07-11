<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['age'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sql = "INSERT INTO users (name, age, status) VALUES ('$name', $age, 0)";
    mysqli_query($conn, $sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['toggle_id'])) {
    $id = $_POST['toggle_id'];
    $get_status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT status FROM users WHERE id=$id"));
    $new_status = $get_status['status'] == 1 ? 0 : 1;
    mysqli_query($conn, "UPDATE users SET status=$new_status WHERE id=$id");
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Toggle App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>User Status Toggle</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <button type="submit">Submit</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['age'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="toggle_id" value="<?= $row['id'] ?>">
                    <button type="submit">Toggle</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>
