<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link 
        rel="icon" 
        href="../../assets/images/favicon.ico" 
    />
    <link 
        rel="stylesheet" 
        href="../css/styles.css" 
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
                    <a href="./index.html">Blugold <span>Buzz</span></a>
                </div>
                <div class="menu">
                <ul>
                        <li><a href="./index.html" class="active">Home</a></li>
                        <li><a href="./buzz.php">Buzz</a></li>
                        <li> <a class="active-page" a href="./club.php">Club</a></li>
                        
                        <?php
                            session_start();
                            $class = $_SESSION['class'] ?? 'logged-out';
                            if ($class === 'logged-in') {
                                echo '
                                <li><a href="./profile.html">Profile</a></li>
                                <li><a href="./logout.php">Logout</a></li>
                                <li><a href="./accountSettings.html">Account</a></li>
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
        <div class="main-container">
            <div class="content">
                <div class="item-wrap">
                    <div class="item">
                        Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Rem quisquam dolor eum? Beatae ex distinctio
                        quibusdam iure reprehenderit iusto aliquam, ipsam
                        dolorem, autem dolorum et unde totam! Beatae,
                        consequatur eligendi.
                    </div>
                </div>
                <div class="item-wrap">
                    <div class="item">
                        Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Rem quisquam dolor eum? Beatae ex distinctio
                        quibusdam iure reprehenderit iusto aliquam, ipsam
                        dolorem, autem dolorum et unde totam! Beatae,
                        consequatur eligendi.
                    </div>
                </div>
                <div class="item-wrap">
                    <div class="item">
                        Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Rem quisquam dolor eum? Beatae ex distinctio
                        quibusdam iure reprehenderit iusto aliquam, ipsam
                        dolorem, autem dolorum et unde totam! Beatae,
                        consequatur eligendi.
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
                <li><a href="./about.html">About Us</a></li>
                <li>this one</li>
            </ul>
        </div>
        <div class="three">
            <ul>
                <li><b>Support</b></li>
                <li>FAQ</li>
                <li><a href="./contact.html">Contact</a></li>
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