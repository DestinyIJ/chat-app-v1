<?php
    include_once "config.php";

    $sql = "SELECT * FROM users WHERE `unique_id`=?";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param('i', $incoming_msg_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user_data = $result->fetch_array(MYSQLI_ASSOC);

    if(!$user_data) {
        $incoming_full_name = "John Doe";
        $incoming_display_image = "img.png";
        $incoming_status = "No such user";
    } else {
        $incoming_full_name = $user_data['fname']. " " .$user_data['lname'];
        $incoming_display_image = "php/images/".$user_data['imgname'];
        $incoming_status = $user_data['status'];
    }
    $stmt->close();
