<?php
    session_start();
    unset($_SESSION["unique_id"]);
    $_SESSION["status"] = "offline";
    include("config.php");

    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $email = strtolower($email);
    $password =  mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){ // Check if any of the field is empty
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) { // check if email is valid
            $sql = "SELECT email FROM users WHERE email='{$email}'";
            $stmt = mysqli_prepare($conn, $sql);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows()){ // check if email already exist
                echo "$email - This email already exist";
            } else {
                $stmt->close();

                $img_name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $time = time();
                $img_name = $time . $img_name;

                if(move_uploaded_file($tmp_name, "images/".$img_name)){
                    $_SESSION["status"] = "Active now";
                    $status = $_SESSION["status"]; // once user signs up, status will be set
                    $random_id = random_int(time(), time()*1000);
                    $random_id = ceil($random_id/1000 + time()/1000);
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $conn->prepare("INSERT INTO `users`( `unique_id`, `fname`, `lname`, `email`, `password`, `imgname`, `status`) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("issssss", $random_id, $fname, $lname, $email, $password, $img_name, $status);
                    
                    if($stmt->execute()) {
                        $sql = "SELECT `unique_id` FROM users WHERE `email`=?";
                        $stmt = mysqli_prepare($conn, $sql);
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $stmt->store_result();

                        if($stmt->num_rows()){ 
                            $stmt->bind_result($unique_id);
                            $stmt->fetch();
                            $_SESSION["unique_id"] = $unique_id;
                            $stmt->close();
                            echo "success";
                        } else {
                            echo "something went wrong while fetching unique id";
                        }

                    } else {
                        echo "something went wrong with data entry";
                    }        
                } else {
                    echo "Please select an image file";
                }
            }
        } else {
            echo "$email - is not a valid email";
        }
    } else {
        echo "All input field are required";
    }

?>