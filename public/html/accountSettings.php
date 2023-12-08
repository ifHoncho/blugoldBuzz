<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="icon" href="../../assets/images/favicon.ico" />
    <link rel="stylesheet" href="../css/styles.css" />
    <style>
        .main-container .content .item-wrap {
            width: 50%;
            padding: 10px;
        }

        .main-container .content .item-wrap .item {
            width: 100%;
            padding: 10px;
            text-align: center;
        }

        .main-container .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%
        }
        @media (max-width: 728px) {
            .main-container .content .item-wrap {
                width: 80%;
                padding: 10px;
            }
        }
    </style>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
    <div class="navbar">
        <div class="inner-navbar">
            <div class="logo">
                <a href="./index.php">Blugold <span>Buzz</span></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./buzz.php">Buzz</a></li>
                    <li><a href="./club.php">Club</a></li>
                    <li><a class="active-page" href="./accountSettings.php">Settings</a></li>
                    <li><a href="./resetPassword.php">Reset Password</a></li> 
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
                    <form class="account-settings-form" method="POST" action="accountSettings.php">
                        <h2>Account Settings</h2>
                        <input type="text" id="username" name="username" placeholder="Current Username">
                        <input type="text" id="new-username" name="new-username" placeholder="New Username">
                        <input type="email" id="email" name="email" placeholder="Current Email">
                        <input type="email" id="new-email" name="new-email" placeholder="New Email">
                        <button type="submit">Save Changes</button>
                    </form>
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
        });
    </script>

    <?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentUsername = $_SESSION['username']; // Retrieve from session
        $currentEmail = $_SESSION['email']; // Retrieve from session

        $username = htmlspecialchars($_POST['username']);
        $newUsername = htmlspecialchars($_POST['new-username']);
        $email = htmlspecialchars($_POST['email']);
        $newEmail = htmlspecialchars($_POST['new-email']);

        // Database connection
        $servername = "localhost";
        $dbUsername = "root";
        $password = "";
        $dbname = "blugoldBuzz";
        $conn = new mysqli($servername, $dbUsername, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update Username
        if (!empty($newUsername) && $username === $currentUsername) {
            $stmt = $conn->prepare("UPDATE userinfo SET username = ? WHERE username = ?");
            $stmt->bind_param("ss", $newUsername, $currentUsername);
            if ($stmt->execute()) {
                echo "<p>Username updated successfully.</p>";
            } else {
                echo "<p>Error updating username: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }

        // Update Email
        if (!empty($newEmail) && $email === $currentEmail) {
            $stmt = $conn->prepare("UPDATE userinfo SET email = ? WHERE email = ?");
            $stmt->bind_param("ss", $newEmail, $currentEmail);
            if ($stmt->execute()) {
                echo "<p>Email updated successfully.</p>";
            } else {
                echo "<p>Error updating email: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }

        $conn->close();
    }
    ?>
</body>
</html>
