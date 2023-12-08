<?php
    $errors = array();
    session_start();

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'blugoldBuzz');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate form data
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        $confirm_password = filter_var(trim($_POST['confirm-password']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $userType = filter_var(trim($_POST['userType']), FILTER_SANITIZE_STRING);
        
            // Check if username already exists
        $stmt = $conn->prepare("SELECT * FROM userinfo WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "Username already exists";
        }
            // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM userinfo WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errors[] = "An account with that email already exists";
        }
        // Validate username
        if (empty($username)) {
            $errors[] = "Username is required";
        }

        // Validate password
        if (empty($password)) {
            $errors[] = "Password is required";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must be at least 6 characters";
        }

        // Validate confirm password
        if (empty($confirm_password)) {
            $errors[] = "Please confirm password";
        } elseif ($password != $confirm_password) {
            $errors[] = "Passwords do not match";
        }

        // Validate email
        if (empty($email)) {
            $errors[] = "Email is required";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL to insert data
        $sql = "INSERT INTO userinfo (username, password, email, userType) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $hashed_password, $email, $userType);

        if ($stmt->execute() === TRUE) {
            echo "New record created successfully";
            header("Location: login.php?registered=true");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    foreach ($errors as $error) {
        echo '<div style="color:red">' . $error . '</div>';
    }
    $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        footer {
            position: relative;
        }

        select#userType {
            width: 100%;
            padding: 10px;
            border: none;
            box-shadow: 0px 0px 3px 1px #33333323;
            border-radius: 5px;
            background-color: #f1f1f1;
            font-size: 16px;
            color: #333;
            appearance: none;
            cursor: pointer;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        /* Add custom arrow */
        select#userType::after {
            content: "\25BC";
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
            background-color: #ccc;
            pointer-events: none;
        }

        /* Style the options */
        select#userType option {
            padding: 10px;
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
                        <li><a href="./club.html">Club</a></li>
                        <li><a class="active-page"  href="./register.php">Register</a> </li>
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
                            <h2>Register</h2><br>
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required>
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                            <label for="confirm-password">Confirm Password:</label>
                            <input type="password" id="confirm-password" name="confirm-password" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                            <select id="userType" name="userType" required>
                                <option value="Student">Student</option>
                                <option value="UW-Club">UW-Club</option>
                            </select>
                            <input type="submit" value="Register" class="btn">
                            <?php
                                foreach ($errors as $error) {
                                    echo '<div style="color:red">' . $error . '</div>';
                                }
                            ?>
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