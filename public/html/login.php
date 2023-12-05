
<?php
    session_start();
    $errorMessages = '';
    include '../../config/functions.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(empty($_POST['username']) && empty($_POST['password']))
        {
            die();
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        //clean the inputs
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $result = check_result($username, $password);

        
        if (is_array($result)) {
            foreach ($result as $error) {
                $errorMessages .= '<div style="color:red">' . $error . '</div>';
            }
             // Unset the session variable when the login fails
            session_unset();
        }
        else if ($result === true)
        {
            //create session information
            $_SESSION['loggedin'] = true; 
            $_SESSION['username'] = $username;
            $_SESSION['id'] = "Username: ".$username." Date:".date("Y-m-d H:i:s");
        
            //redirect the browser
            $_SESSION['message'] = 'Login successful!';
            header("Location: index.php");
            exit();
        }
    }
    ob_end_flush(); 
        ?>
<?php
    if (isset($_GET['registered']) && $_GET['registered'] == 'true') {
        echo '<div style="color:green">You have successfully created an account.</div>';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link 
        rel="icon" 
        href="../assets/images/favicon.ico" 
    />
    <link 
        rel="stylesheet" 
        href="../css/styles.css" 
    />
    <!--<link rel="stylesheet" href="../css/contact.css" /> --->

    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <style>
        form > p {
            text-align: center;
        }
        button {
            width: 100%;
            background: #213555;
        }
        button a {
            color: white;
            font-size: large;
            font-weight: bold;
            letter-spacing: .1em;
        }
        button:hover {
            transform: scale(.95);
            opacity: .95;
            transition: .2s ease-in-out;
        }
        form button:hover {
            border-bottom: none;
        }
        input[type="submit"] {
            font-weight: bold;
            font-size: large;
            letter-spacing: .1em;
            background: #4F709C;
            color: white;
            cursor: pointer;
            height: 40px;
        }
        input[type="submit"]:hover {
            transform: scale(.95);
            opacity: .95;
            transition: .2s ease-in-out;
        }
        footer {
            display: block;
            position: absolute;
            bottom: 0;
            width: 100%
        }
        @media (min-width: 728px) {
            
            .item {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-template-rows: 1fr;
            }
            .item form {
                grid-row: 1 / 1;
                grid-column: 2 / 3;
            } 
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
                        <li><a href="./club.php">Club</a></li>
                        <li><a class="active-page"  href="./login.php">Login</a> </li>
                        <li><a href="./accountSettings.html">Settings</a></li>
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
                            <form method="POST">
                                <h2>Login</h2><br>
                                <label for="username">Username:</label>
                                <input type="username" id="username" name="username" required>
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required>
                                <?php echo $errorMessages; ?>
                                <input type="submit" value="Login" class="btn">
                                <p>Don't have an account?</p>
                                <button><a href="./register.php" class="btn">Create Account</a></button>
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