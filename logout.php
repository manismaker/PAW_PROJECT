<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <form method="POST" action="logout.php">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
