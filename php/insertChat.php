<?php
    session_start();
    include("config.php");
    
    if(isset($_SESSION["unique_id"])) {
        $incoming_id = (int) mysqli_real_escape_string($conn, $_POST["incoming_id"]);
        $outgoing_id = (int) mysqli_real_escape_string($conn, $_POST["outgoing_id"]);
        $message = $_POST["message"];

        
        if(!empty($message)) {
            $sql = "INSERT INTO `messages`(`incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES(?,?,?)";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->bind_param("iis", $incoming_id, $outgoing_id, $message);
            $stmt->execute();
        }

    } else {
        header("Location: ../login.php");
    }
    
?>