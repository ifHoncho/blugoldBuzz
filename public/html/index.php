<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Blugold Buzz</title>
    <link rel="icon" href="../../assets/images/favicon.ico" />
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/homepage.css" />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body class="body">
    <div class="main">
         <div class="navbar">
            <div class="inner-navbar">
                <div class="logo">
                    <a href="./index.php">Blugold <span>Buzz</span></a>
                </div>
            </div>
        </div>
        <div class="central-menu">
        <ul>
            <li><a href="./index.php" class="active">Home</a></li>
            <li><a href="./buzz.php">View The Buzz</a></li>
            <li> <a href="./club.php">Club Activity</a></li>
            
            <?php
                session_start();
                $class = $_SESSION['class'] ?? 'logged-out';
                if ($class === 'logged-in') {
                    echo '
                    <li><a href="./logout.php">Logout</a></li>
                        ';
                } else {
                    echo '<li><a href="./login.php">Log In/Register</a> </li>';
                }
            ?>
        </ul>
        </div>
        <footer>
            <p>© 2023 Blugold Buzz. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>