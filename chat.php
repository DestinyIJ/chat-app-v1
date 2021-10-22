<?php 
    session_start();
    include("php/config.php");
    $incoming_msg_id =(int) mysqli_real_escape_string($conn, $_GET['incoming_id']);
    $outgoing_msg_id = $_SESSION["unique_id"];
    include('php/userdata.php');
    include('header.php'); 
?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="<?php echo $incoming_display_image ?>" alt="">
                <div class="details">
                    <span><?php echo $incoming_full_name ?></span>
                    <p><?php echo $incoming_status ?></p>
                </div>
            </header>
            <div class="chat-box scrollToBottom"></div>

            <form action="" class="typing-area" method="POST" autocomplete="off">
                <input type="hidden" name="outgoing_id" value="<?php echo $outgoing_msg_id; ?>">
                <input type="hidden" name="incoming_id" value="<?php echo $incoming_msg_id; ?>">
                <input type="text" name="message" class="input-field" placeholder="Type a message here">
                <button><span class="fab fa-telegram-plane"></span></button>
            </form>
        </section>
    </div>

    <script src="javascript/userChat.js"></script>
</body>
</html>