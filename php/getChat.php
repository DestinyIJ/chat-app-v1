<?php
    session_start();
    include("config.php");
    

    if(isset($_SESSION["unique_id"])) {
        $incoming_msg_id = (int) mysqli_real_escape_string($conn, $_POST["incoming_id"]);
        $outgoing_msg_id = (int) mysqli_real_escape_string($conn, $_POST["outgoing_id"]);
        include('userdata.php');
        
        $sql = "SELECT * FROM `messages` 
                WHERE (`incoming_msg_id`=? AND `outgoing_msg_id`=?) 
                OR (`incoming_msg_id`=? AND `outgoing_msg_id`=?)
                ORDER BY `msg_id`";
        $stmt = mysqli_prepare($conn, $sql);
        $stmt->bind_param("iiii",$incoming_msg_id, $outgoing_msg_id, $outgoing_msg_id, $incoming_msg_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $message_data = $result->fetch_all(MYSQLI_ASSOC);
        $output = "";
        

        foreach($message_data as $message) {
            if($message["outgoing_msg_id"] === $outgoing_msg_id){
                $outgoing_message = $message['msg'];
                $output .= "<div class='chat outgoing'>
                                <div class='details'>
                                    <p>$outgoing_message</p>          
                                </div>
                            </div>";
            } else {
                $incoming_message = $message['msg'];
                $output .= "<div class='chat incoming'>
                                <img src='$incoming_display_image' alt=''>
                                <div class='details'>
                                    <p>$incoming_message</p>
                                </div>
                            </div>";
            }   
        }
        echo $output;

        
    } else {
        
        header("Location: ../login.php");
    }

?>