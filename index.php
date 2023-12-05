
<?php
//IF USER LOGS IN, DISPLAY SUCCESS NOTIFICATION
    session_start();
    if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
        echo '<header id="success-header" class="hidden">Login successful!</header>';
    // Unset the variable so the message doesn't keep showing up on refresh
        unset($_SESSION['login_success']);
        header("Location: " . $_SERVER['REQUEST_URI']);
    }
    
    $class = (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) ? 'logged-out' : 'logged-in';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to BluGold Buzz</title>
    <link 
        rel="icon"
        href="../assets/images/favicon.ico"
    />
    <link
        rel="stylesheet"
        href="./css/styles.css"
    />
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <style>
        .nav-bar {
            z-index:2;
            position: relative;
        }
        body {
            margin: 0;
            padding: 0;
            background: aliceblue;
        }
        footer {
            padding-top: 50px;
        }
        /* Main Container Styles */
        .main-container {
            display: grid;
            grid-template-rows: auto 1fr;
            grid-template-columns: repeat(7,1fr);
            gap: 15px;
            z-index: 0; /* Ensures the image stays behind the content */
            box-sizing: border-box;
            padding-left:0;
            padding-right:0;
            padding-top:0;
            min-height: 700px;
        }
        .heading {
            grid-column: 1 / 8;
            display: grid;
            grid-template-columns: repeat(7,1fr);
            grid-template-rows: 1fr;
            text-align: center;
            font-family: inherit;
            font-size: x-large;
            letter-spacing: .2em;
            border-bottom: 4px solid; 
            position: relative; /* New */
            z-index: -1; /* New */
        }
        header.hidden {
            height: 0px;
        }
            .heading::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('../assets/images/homepage.jpg') no-repeat center center; 
                background-size: cover;
                opacity: 0.5; /* Adjust this to change the opacity */
                z-index: -2; /* New */
            }
        .main-container .content {
            grid-row: 2 / 2;
            grid-column: 3 / 6;
            gap: 20px;
            
        }
        .main-container .heading h3.small {
                display: none;
            }
        .item-wrap, .item {
                border-radius: 5px;
        }
        .heading {
            grid-column: 1 / 8;
            display: grid;
            grid-template-columns: repeat(7,1fr);
            grid-template-rows: 1fr;
            text-align: center;
            font-family: inherit;
            font-size: x-large;
            letter-spacing: .2em;
            border-bottom: 4px solid; 
            height: auto;
        }
        
        .heading div.recent {
            grid-column: 3 / 6;
            grid-row: 1 / 1;
        }
        .post {
            grid-row: 2 / 2;
            grid-column: 1 / 3;
            background: #fff;
            min-height: 200px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            display: grid;
            grid-template-rows: 1fr;
            grid-template-columns: 1fr;
        }
        .post form {
            grid-row: 1 / 1;
            grid-column: 1 / 1;
            display: grid;
            height: 250px;
            width: 100%;
            grid-template-columns: repeat(5,1fr);
            grid-template-rows: repeat(5,1fr);
        }
        form > .post-input{
            grid-column: 1 / 6;
            grid-row: 1 / 2;
        }
        form > .post-button{
            grid-column: 3 / 4;
            grid-row: 4 / 6;
        }
        form > .post-button input[type="submit"]{
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            font-size: large;
            font-weight: bold;
            box-shadow: 0px 0px 3px 1px #33333323;
            font-family: inherit;
            letter-spacing: .2em;
            background-color: #4F709C;
            color: #fff;
            width: 100px;
            text-align: center;
        }
        form > .post-button:hover {
            transition: .2s ease-out;
            scale: 1.1 1.2;
        }
        form > .post-image{
            text-align: center;
            grid-row: 2 / 5;
            grid-column: 2 / 5;
        }
        form > .post-image input[type="file"] {
            display: none;
        }
        form > .post-image label {
            padding: 10px 20px;
            background-color: #4F709C;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
            font-size: large;
            font-weight: bold;
            text-align: center;
            transition: .2s ease-out;
            position: relative;
            top: 20px;
        }
        form > .post-image label:hover {
            background-color: #3F609C;
        }
        .trending {
            grid-row: 2 / 2;
            grid-column: 6 / 8;
            background: #fff;
            height: 66%;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 10% repeat(4,1fr);
            margin-right:20px;
        }
        .trending h4 {
            grid-row: 1 / 1;
            grid-column: 1 / 1;
            text-align: center;
            padding-top: 10px;
            font-size: large;
            letter-spacing: .2em;
            border-bottom: 3px solid;
        }
        .trending-content1 {
            grid-row: 2 / 3;
            grid-column: 1 / 1;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.219);
            margin: 10px;
            height: auto;
        }
        .trending-content2 {
            grid-row: 3 / 4;
            grid-column: 1 / 1;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.219);
            margin: 10px;
            height: auto;
        }
        .trending-content3 {
            grid-row: 4 / 5;
            grid-column: 1 / 1;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.219);
            margin: 10px;
            height: auto;
        }
        .trending-content4 {
            grid-row: 5 / 6;
            grid-column: 1 / 1;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.219);
            margin: 10px;
            height: auto;
        }
        #success-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 20px;
            background-color: green;
            color: white;
            text-align: center;
            opacity: 1;
            transition: opacity 2s;
            z-index: 3;
        }
        #success-header.hidden {
            opacity: 0;
            z-index: -1;
        }
        .content {
            overflow: auto;
            box-sizing: border-box;
        }
        .main-container.logged-out .content {
            grid-column: 1 / 5;
        }

        .main-container.logged-out .trending {
            grid-column: 5 / 8;
        }

        .main-container.logged-out .post {
            display: none;
        }
    .recent {
        padding-top: 20px;
    }
    .item-wrap, .item {
        height: auto;
    }        
    @media (max-width: 400px) {
        .main-container .post,
        .main-container .trending {
            display: none;
        }
        .main-container.logged-in .content {
            grid-column: 1 / 8;
            display: block;
        }
        .main-container .heading h3.large {
            display: none;
        }
        .main-container .heading h3.small {
            display: contents;
        }
        .item-wrap, .item {
            margin-left: 20px;
            margin-right: 20px;
        }
    }
    
    @media (min-width:400px) and (max-width: 728px) {
        .main-container.logged-out .content {
            grid-column: 1 / 8;
        }
        .main-container.logged-out .post {
            display: none;
        }
        .main-container.logged-in .content {
            grid-column: 1 / 8;
        }
        .main-container.logged-in .post {
            display: none;
        }
        .main-container.logged-in .trending {
            display: none;
        }
        .main-container .heading h3.large {
            display: none;
        }
        .main-container .heading h3.small {
            display: contents;
        }
    }
    @media (min-width: 728px) {
        .trending h4 {
            padding: 10px;
            border-bottom: none;
        }
        .content {
            min-height: 80vh;
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
                        <li><a class="active-page" href="./index.php" class="active">Home</a></li>
                        <li><a href="./club.html">Club</a></li>
                        
                        <?php
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
        <header class="hidden" id="success-header">
        <?php 
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                // Unset the message after displaying it
            }
        ?></header>
        <div class="main-container <?php echo $class; ?>">
            <div class="heading">
                <div class="recent">
                    <h3 class="large">Here's What's Buzzing Today</h3>
                    <h3 class="small">Recent Posts</h3>
                </div>
            </div>
            <?php
            // IF USER IS LOGGED IN, POSTING IS AVAILABLE
            if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
                echo '
            <div class="post">
                <form action="post.php" method="post" enctype="multipart/form-data">
                    <div class="post-input">
                        <textarea id="content" name="content" placeholder="What\'s happening?"></textarea><br>
                    </div>
                    <div class="post-image">
                        <input type="file" id="photo" name="photo" onchange="previewFile()">
                        <label for="photo">Upload Photo</label>
                        <img id="preview" src="" height="200" alt="Image preview...">
                    </div>
                    <div class="post-button">
                        <input type="submit" value="Post">
                    </div>
                </form>
            </div>
                ';
            } else {
                echo '<div class="post"></div>';
            }
            ?>
            <div class="trending">
                <h4>Trending Now</h4>
                <div class="trending-content1">

                </div>
                <div class="trending-content2">

                </div>
                <div class="trending-content3">

                </div>
                <div class="trending-content4">

                </div>
            </div>
            <div class="content">
                <div class="item-wrap">
                    <div class="item">
                        Lorem ipsum dolor sit amet consectetur adipisicing 
                        elit. Rem quisquam dolor eum? Beatae ex distinctio 
                        quibusdam iure reprehenderit iusto aliquam.
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
                <li><a href="./about.html">About Us</a></li>
                <li>this one</li>
                <li>this one</li>
            </ul>
        </div>
        <div class="three">
            <ul>
                <li><b>Support</b></li>
                <li>FAQ</li>
                <li><a href="./contact.html">Contact Us</a></li>
            </ul>
        </div>
        <div class="four">
            <p>© 2023 Blugold Buzz. All rights reserved.</p>
        </div>
    </footer>
<script>
    var dropDown = document.querySelector(".dropdown");
    var menu = document.querySelector(".menu");

    dropDown.addEventListener("click",function(){
        menu.classList.toggle("active");
    })
        window.onload = function() {
        var header = document.getElementById('success-header');
        if (header && header.textContent.trim() !== '') {
            header.classList.remove('hidden');

            // After 2 seconds, add the 'hidden' class back to the header
            setTimeout(function() {
                header.classList.add('hidden');
            }, 2000);
        }   
    }
    document.getElementById('small-post-button').addEventListener('click', function() {
        var inputBox = document.getElementById('input-box');
        if (inputBox.style.display === 'none') {
            inputBox.style.display = 'block';
        } else {
            inputBox.style.display = 'none';
        }
    });

    function previewFile() {
    const preview = document.querySelector('#preview');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        // convert image file to base64 string
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}
</script>
</body>
</html>

<?php
if (isset($_SESSION['message']) && $_SESSION['message'] === 'Logout successful!') {
    unset($_SESSION['message']);
}
?>