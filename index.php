<?php
include "db.php";

// SELECT QUERY -> GET all fields by default
$query = "SELECT * FROM messages ORDER BY create_date DESC";
$messages = mysqli_query($conn, $query);

// Check error messages
$error = "";
if (isset($_GET["error"])){
    $error = $_GET["error"];
}

// Check success messages
$success = "";
if (isset($_GET["success"])){
    $success = $_GET["success"];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>MessageApp</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>MessageApp</h1>
        </header>
        
        <main>
            <?php if ($error != "") : ?>
                <div class="error"><?php echo $error ?></div>
            <?php endif; ?>
            
            <?php if ($success != "") : ?>
                <div class="success"><?php echo $success ?></div>
            <?php endif; ?>
            
            <form method="POST" action="process.php">
                <input type="text" name="text" placeholder="Enter text">
                <input type="text" name="user" placeholder="Enter user">
                <input type="submit" value="Submit">
            </form>
            
            <hr>
            
            <ul class="messages">
                <!-- Print row by row using a while loop -->
                <?php while($row = mysqli_fetch_assoc($messages)) : ?>
                    <li>
                        <?php echo $row['text']." | ". $row['user']." [ ". $row['create_date']."] "; ?>
                        <a href="process.php?action=delete&id=<?php echo $row['id'] ?>">[X]</a>
                    </li>
                <?php endwhile; ?>                
            </ul>
            
        </main>
        
        <footer>
            MessageApp &copy; 2020
        </footer>
    </div>
</body>
</html>