<?php
function loadPosts() {

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'blugoldbuzz';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $column1 = 'username';
    $column2 = 'content';
    $table1 = 'post';
    $table2 = 'userinfo';
    $sql = "SELECT t1.$column1, t1.$column2 
    FROM $table1 t1
    JOIN $table2 t2 ON t1.$column1 = t2.$column1
    WHERE t2.userType = 'UW-Club'";

    // Execute the query
    $result = $conn->query($sql);

    if ($result) {
        // Iterate through each row and echo the values
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<img src='../../assets/images/defaultProfile.jpg' alt='User Name'>";
            echo "<div><h3>" . $row[$column1] . "</h3>";
            echo "<p>" . $row[$column2] . "</p></div>";
            echo "</div>";
        }

        // Free result set
        $result->free();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blugold Buzz - Buzz</title>
    <link rel="icon" href="../../assets/images/favicon.ico" />
    <link rel="shortcut-icon" href="../../assets/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/buzz.css" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

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
                        <li> <a class="active-page" a href="./club.php">Club</a></li>
                        
                        <?php
                            session_start();
                            $class = $_SESSION['class'] ?? 'logged-out';
                            if ($class === 'logged-in') {
                                echo '
                                <li><a href="./profile.php">Profile</a></li>
                                <li><a href="./logout.php">Logout</a></li>
                                <li><a href="./accountSettings.php">Account</a></li>
                                    ';
                            } else {
                                echo '<li><a href="./login.php">Login</a> </li>';
                                echo '<li><a href="./register.php">Register</a> </li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="dropdown">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="pcontainer">
            <div class="pmain">
                <section class="post-box">
                    <textarea placeholder="What's happening?"></textarea>
                    <button>Post</button>
                </section>
                

                <div class="feed">
                    <?php 
                    loadPosts(); ?>
                    <!-- Example post 
                    <div class="post">
                        <img src="../../assets/images/peter.jpg" alt="User Name">
                        <div>
                            <h3>Peter Griffin</h3>
                            <p>Buzz test</p>
                        </div>
                    </div>
                    -->
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