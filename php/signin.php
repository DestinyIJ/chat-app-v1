<?php
    session_start();
    unset($_SESSION["unique_id"]);
    include("config.php");

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password)) {
        $sql = "SELECT `password`,`unique_id` FROM users WHERE `email`=?";
        $stmt = mysqli_prepare($conn, $sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if($stmt->num_rows()) {
            $stmt->bind_result($hashed_password, $unique_id);
            $stmt->fetch();
            $stmt->close();

            if(password_verify($password, $hashed_password)) {
                $_SESSION["unique_id"] = $unique_id;
                $status = "Active now";
                //  update database
                $stmt = $conn->prepare("UPDATE `users` SET `status`=? WHERE `unique_id`=?");
                $stmt->bind_param("si", $status, $unique_id);
                $stmt->execute();
                $stmt->close();
                echo "success"; 
            } else {
                echo "Wrong email or password";
            }
        } else {
            echo "Wrong email or password";
        }
    } else {
        echo "All input field must be filled";
    }
?>