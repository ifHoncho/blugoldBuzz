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
                        <li><a class="active-page" href="./resetPassword.html">Reset Password</a></li>
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
                        <form class="account-settings-form">
                            <h2>Reset Password</h2>
                            <input type="password" id="password" name="password" placeholder="Current Password">
                            <input type="password" id="new-password" name="new-password" placeholder="New Password">
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