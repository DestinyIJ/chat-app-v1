<?php
    session_start();

    if(!isset($_SESSION["unique_id"])){
        header("Location: login.php");
    } else {
        $unique_id = $_SESSION["unique_id"];
    } 
?>

<?php include('header.php'); ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                    include_once "php/config.php";
                    
                    $sql = "SELECT `fname`, `lname`, `imgname`, `status` FROM users WHERE unique_id=?";
                    $stmt = mysqli_prepare($conn, $sql);
                    $stmt->bind_param("i", $unique_id);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($fname,$lname,$imgname, $status);
                    $stmt->fetch();
                
                    $imgpath = "php/images/".$imgname;     
                ?>
                <div class="content">
                    <img src="<?php echo $imgpath;?>" alt="">
                    <div class="details">
                        <span><?php echo $fname." ".$lname;?></span>
                        <p><?php echo $status;?></p>
                    </div>
                </div>
                <a href="login.php?signoutid=<?php echo $unique_id;?>" class="logout">Logout</a>
            </header>

            <div class="search">
                <span class="text">Select user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><span class="fas fa-search"></span></button>
            </div>

            <div class="users-list">
            </div>
        </section>
    </div>

    <script src="javascript/user.js"></script>
    <script>
        

    </script>
</body>
</html>