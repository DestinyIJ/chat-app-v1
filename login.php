<?php
    session_start();
    if(isset($_SESSION["unique_id"])){
        header("Location: users.php");
    } else {
        unset($_SESSION["unique_id"]);
    }

    include("php/config.php");

    if(isset($_GET['signoutid'])) {
        $signOutid = (int)$_GET['signoutid'];
        $status = "offline";
        //  update database
        $stmt = $conn->prepare("UPDATE `users` SET `status`=? WHERE `unique_id`=?");
        $stmt->bind_param("si", $status, $signOutid);
        $stmt->execute();
        $stmt->close();
    }
?>
<?php include('header.php'); ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="" method="POST">
                <div class="error-text"></div>
                <div class="field input">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your Email" required><br><br>
                </div>
                <div class="field input">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>
                    <span class="fas fa-eye"></span>
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Continue to Chat">
                </div>
            </form>

            <div class="link">Not yet signed up? <a href="index.php">Signup Now</a></div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signin.js"></script>
</body>
</html>