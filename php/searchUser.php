<?php
    session_start();  
    include_once "config.php";
    $outgoing_msg_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST["searchTerm"]);
    $searchTerm = "%".$searchTerm."%";
    
    $sql = "SELECT * FROM users WHERE (`fname` LIKE ? OR `lname` LIKE ?) AND `unique_id`!= ?";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("ssi", $searchTerm, $searchTerm, $outgoing_msg_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $users_data = $result->fetch_all(MYSQLI_ASSOC);
    $output = "";

    if(!$users_data) {
        $output .= "User not found for your search";
    } else {
        foreach($users_data as $user_data) {
             // get user image filename
             $user_image_name = $user_data["imgname"];
             $imgpath = "php/images/".$user_image_name;
             // get user full name
             $user_full_name = $user_data['fname'] . " " .$user_data['lname'];
             // get user unique id
             $chat_user_id = $user_data['unique_id'];
 
             $sql = "SELECT * FROM `messages` 
                     WHERE (`incoming_msg_id`=? AND `outgoing_msg_id`=?) 
                     OR (`incoming_msg_id`=? AND `outgoing_msg_id`=?)
                     ORDER BY `msg_id` DESC LIMIT 1";
             $stmt = mysqli_prepare($conn, $sql);
             $stmt->bind_param("iiii",$chat_user_id, $outgoing_msg_id, $outgoing_msg_id, $chat_user_id);
             $stmt->execute();
             $result = $stmt->get_result();
             $message_data = $result->fetch_assoc();
             if(!$message_data) {
                 $message = "Enter to chat";
             } else {
                 $message = $message_data['msg'];
             }
             
             // trimming message by string length
             (strlen($message) > 28) ? $display_message = substr($message,0,28)."..." : $display_message = $message;
             ($outgoing_msg_id == $message_data['outgoing_msg_id']) ? $display_message = "You:".$display_message : $display_message;
 
             $output .= "<a href='chat.php?incoming_id=$chat_user_id'>
                             <div class='content'>
                                 <img src='$imgpath' alt=''>
                                 <div class='details'>
                                     <span>$user_full_name</span>
                                     <p>$display_message</p>
                                 </div>
                             </div>
                             <div class='status-dot'>
                                 <span class='fas fa-circle'></span>
                             </div>
                         </a>";
        }
    }
     echo $output;
?>