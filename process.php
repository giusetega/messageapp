<?php

include "db.php";

// POST -> INSERT -> Control of data sent by the form
if (isset($_POST['text']) && isset($_POST['text'])){
    if($_POST['text'] != "" && $_POST['user'] != ""){
        $text = mysqli_real_escape_string($conn, $_POST['text']);
        $user = mysqli_real_escape_string($conn, $_POST['user']);
        $user = strtoupper($user);

        $query = "INSERT INTO messages (text, user) VALUES('$text', '$user')";

        if (mysqli_query($conn, $query)){            
            header("Location: index.php?success=Text inserted");
        } else {
            die(mysqli_error($conn));
        }

    } else {
        header("Location: index.php?error=Fill in all fields");
    }
}

// GET -> DELETE
if (isset($_GET['action']) && isset($_GET['id'])){
    if ($_GET['action'] == "delete" && $_GET['id'] >= 0){
        $delete = $_GET['action'];    
        $id = $_GET['id'];

        $getUserQuery = "SELECT user FROM messages WHERE id = $id";
        $userDeleted = mysqli_query($conn, $getUserQuery);

        $query = "DELETE FROM messages WHERE id = $id";

        $user = getUserDeleted($conn, $id);

        if (mysqli_query($conn, $query)){
            $message = "The text of the user ". $user." has been removed";
            header("Location: index.php?success=".$message);
        } else {
            die(mysqli_error($conn));
        }
    }
}

function getUserDeleted($conn, $id){
    $getUserQuery = "SELECT user FROM messages WHERE id = $id";
    $result = mysqli_query($conn, $getUserQuery);
    while($row = mysqli_fetch_assoc($result)){
        return $row['user'];
    }
}

?>