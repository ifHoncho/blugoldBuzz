<?php //we do not have a mail server, but this is how we can implement it
    /*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(empty($_POST['email']) && empty($_POST['password']))
        {
            die();
        }
        $email = $_POST['email'];

        //clean the inputs
        $email = htmlspecialchars($email);

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "blugoldBuzz";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = $conn->prepare("SELECT password FROM userinfo WHERE email = ?");
        if ($sql === false) {
            die('Invalid query: ' . $conn->error);
        }
        
        $bind_result = $sql->bind_param("s", $email);
        if ($bind_result === false) {
            die('Failed to bind email: ' . $sql->error);
        }
        
        $execute_result = $sql->execute();
        if ($execute_result === false) {
            die('Failed to execute query: ' . $sql->error);
        }
        
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        
        if ($row === null) {
            die('No user with such email found');
        }
        
        $password = $row['password'];
        
        $to = $email;
        $subject = "Blugold Buzz Password";
        $txt = "Your password is: ".$password;
        $headers = "From: Blugold Buzz";
        
        $mail_result = mail($to,$subject,$txt,$headers);
        if ($mail_result === false) {
            die('Failed to send email');
        }

        $conn->close();
    } */
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset-password</title>
    <link 
        rel="icon" 
        href="../../assets/images/favicon.ico" 
    />
    <link 
        rel="stylesheet" 
        href="../css/styles.css" 
    />
    <link 
        rel="stylesheet" 
        href="../css/resetPassword.css" 
    />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

    <style>
         .main-container {
            height: 70vh;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="navbar">
            <div class="inner-navbar">
                <div class="logo">
                    <a href="./index.php">Blugold <span>Buzz</span></a>
                </div>
                <div class="menu">
                    <ul>
                        <li><a href="./index.php" class="active">Home</a></li>
                        <li><a href="./club.html">Club</a></li>
                        <li><a href="./accountSettings.html">Settings</a></li>
                        <li><a class="active-page" href="./forgotPassword.php">Reset Password</a></li>
                    </ul>
                </div>
            </div>
            <div class="dropdown">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="main-container">
            <div class="content">
                <div class="item-wrap">
                    <div class="item">
                        <form method="POST" class="account-settings-form">
                            <h2>Get Password</h2>
                            <input type="email" id="email" name="email" placeholder="Enter Email..." required>
                            <button type="submit">Send Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="one">
            <ul>
                <li><b>Legal</b></li>
                <li>Terms of Service</li>
                <li>Privacy Policy</li>
            </ul>
        </div>
        <div class="two">
            <ul>
                <li><b>Useful Links</b></li>
                <li>this one</li>
                <li>this one</li>
                <li>this one</li>
            </ul>
        </div>
        <div class="three">
            <ul>
                <li><b>Support</b></li>
                <li>FAQ</li>
                <li>Contact Us</li>
            </ul>
        </div>
        <div class="four">
            <p>© 2023 Blugold Buzz. All rights reserved.</p>
        </div>
    </footer>
    <script>
        var dropDown = document.querySelector(".dropdown");
        var menu = document.querySelector(".menu");

        dropDown.addEventListener("click", function () {
            menu.classList.toggle("active");
        })
    </script>
</body>

</html>