<?php
    session_start();
    if(isset($_SESSION["unique_id"])){
        header("Location: users.php");
    } 
?>
<?php include('header.php'); ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App</header>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="firstName">First name:</label>
                        <input type="text" id="firstName" name="fname" placeholder="First Name" required><br><br>
                    </div>
                    <div class="field input">
                        <label for="lastName">Last name:</label>
                        <input type="text" id="lastName" name="lname" placeholder="Last Name" required><br><br>
                    </div>
                </div>
                    <div class="field input">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your Email" required><br><br>
                    </div>
                    <div class="field input">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter New Password" required><br><br>
                        <span class="fas fa-eye"></span>
                    </div>
                    <div class="field image">
                        <label for="image">Select Image:</label>
                        <input type="file" id="image" name="image" accept="image/*" required><br><br>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to Chat">
                    </div>
            </form>

            <div class="link">Already Signed Up? <a href="login.php">Login here</a></div>
        </section>
    </div>

    
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
</body>
</html>