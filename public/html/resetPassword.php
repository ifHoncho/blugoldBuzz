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
                        <li><a href="./buzz.php">Buzz</a></li>
                        <li><a href="./club.php">Club</a></li>
                        <li><a href="./accountSettings.html">Settings</a></li>
                        <li><a class="active-page" href="./resetPassword.php">Reset Password</a></li>
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
                            <h2>Reset Password</h2>
                            <input type="username" id="formUsername" name="formUsername" placeholder="Username">
                            <input type="password" id="formPassword" name="formPassword" placeholder="Current Password">
                            <input type="password" id="formNewPassword" name="formNewPassword" placeholder="New Password">
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    session_start();
                                    $loggedInUsername = $_SESSION['username'];
                                    $formUsername = $_POST['formUsername'];
                                    $formPassword = $_POST['formPassword'];
                                    $formNewPassword = $_POST['formNewPassword'];
                            
                                    //clean the inputs
                                    $loggedInUsername = htmlspecialchars($loggedInUsername);    
                                    $formUsername = htmlspecialchars($formUsername);
                                    $formPassword = htmlspecialchars($formPassword);
                                    $formNewPassword = htmlspecialchars($formNewPassword);
                                    $hashedPassword = password_hash($formNewPassword, PASSWORD_DEFAULT);
                            
                                    
                                    if ($loggedInUsername !== $formUsername) {
                                            echo '
                                                <p style="COLOR: RED;">
                                                    The provided username does not match the logged in user
                                                </p>
                                            ';
                                    } else {
                                        //check if the password matches the one in the database
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
                                    
                                        $sql = "SELECT password FROM userinfo WHERE username = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $formUsername);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();
                                        $prevHashedPassword = $row['password'];
                                    
                                        if (password_verify($formPassword, $prevHashedPassword)) {
                                            //update the password
                                            $sql = "UPDATE userinfo SET password = ? WHERE username = ?";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("ss", $hashedPassword, $formUsername);
                                            $stmt->execute();
                                            echo '
                                                <p style="COLOR: GREEN;">
                                                    Password successfully updated
                                                </p>
                                            ';
                                        } else {
                                            echo '
                                                <p style="COLOR: RED;">
                                                    The provided password does not match the one in the database
                                                </p>
                                            ';
                                        }
                                    }
                                }
                            ?>
                            <button type="submit">Save Changes</button>
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