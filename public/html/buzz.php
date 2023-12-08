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

    $sql = "SELECT username, content, post_date, id FROM post ORDER BY post_date DESC LIMIT 10";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Execute the query
    $executeResult = $stmt->execute();
    if ($executeResult === false) {
        die("Error executing statement: " . $stmt->error);
    }

    $result = $stmt->get_result();

    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
    foreach ($posts as $post) {
        echo '
        <div class="item-wrap">
            <div class="item">
                <img src="../../assets/images/defaultProfile.jpg" alt="User Name"><br>
                <h3>'. $post['username'] .'</h3><br>
                <p>' . $post['content'] . '</p><br>
                <p> Posted on: ' . date('F j, Y', strtotime($post['post_date'])) . '</p>
            </div>
        </div>
        ';
    }


    $stmt->close();
    $conn->close();
}




//IF USER LOGS IN, DISPLAY SUCCESS NOTIFICATION
session_start();
if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
    echo '<header id="success-header" class="">Login successful!</header>';
// Unset the variable so the message doesn't keep showing up on refresh
    unset($_SESSION['login_success']);
    header("Location: " . $_SERVER['REQUEST_URI']);
}

$class = (!isset($_SESSION['user_logged_in']) || !$_SESSION['user_logged_in']) ? 'logged-out' : 'logged-in';
$_SESSION['class'] = $class;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to BluGold Buzz</title>
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
        .nav-bar {
            z-index:4;
            position: relative;
        }
        body {
            margin: 0;
            padding: 0;
            background: aliceblue;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        footer {
            padding-top: 50px;
            flex-shrink: 0;
        }
        .main-container {
            display: grid;
            grid-template-rows: 100px 1fr;
            grid-template-columns: repeat(7,1fr);
            gap: 15px;
            z-index: 0;
            box-sizing: border-box;
            padding-left:0;
            padding-right:0;
            padding-top:0;
            min-height: 700px;
            flex: 1 0 auto;
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
            position: relative;
            z-index: -1; 
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
                background: url('../../assets/images/homepage.jpg') no-repeat center center; 
                background-size: cover;
                opacity: 0.5; 
                z-index: -2; 
            }
        .main-container .content {
            grid-row: 2 / 2;
            grid-column: 3 / 6;
            
            
        }
        .main-container .heading h3.small {
            display: none;
        }
        
        .item-wrap, .item {
            width: 100%;
            border-radius: 5px;
            padding: 10px;
            display: grid;
            grid-template-columns: 80px 1fr;
            grid-template-rows: repeat(3,auto);
            gap: 10px;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.219);
        }

        .item {
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-all;
        }
        .item img {
            grid-row: 2 / 3;
            grid-column: 1 / 2;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-right: 10px;
            box-shadow: 0px 0px 3px 1px #33333323;
        }

        .item h3 {
            grid-row: 1 / 2;
            grid-column: 2 / 3;
            margin: 0;
            font-size: large;
            letter-spacing: .2em;
        }

        .item p {
            grid-row: 2 / 3;
            grid-column: 2 / 3;
            margin: 0;
            font-size: medium;
            letter-spacing: .1em;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .item p:last-child {
            grid-row: 3 / 4;
            grid-column: 2 / 3;
            margin: 0;
            font-size: small;
            letter-spacing: .2em;
        }

        .item-wrap {
            display: flex;
            justify-content: center;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.219);
            height: auto;
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
            grid-column: 1 / 3;
            grid-row: 2 / 2;
            background: #fff;
            height: 200px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-left: 20px;
            display: flex;
            flex-direction: column;
        }
        .post form {
            display: grid;
            grid-template-rows: repeat(3,auto);
            grid-template-columns: repeat(7,1fr);
            max-height: 300px;
            width: 100%;
        } 
        form > .post-input{
            grid-row: 1 / 3;
            grid-column: 1 / 8;
            margin: 10px;
        }
        form > .post-button{
            grid-row: 3 / 4;
            grid-column: 3 / 6;
            display: flex;
            justify-items: center;
        }
        form > .post-button input[type="submit"]{
            padding: 10px 20px;
            flex: 1;
            max-width: 300px;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0px 0px 3px 1px #33333323;
            font-family: inherit;
            letter-spacing: .2em;
            background-color: #4F709C;
            color: #fff;
            text-align: center;
        }
        form > .post-button:hover {
            transition: .2s ease-out;
            transform: scale(.95);
        } 
        .trending {
            grid-row: 2 / 2;
            grid-column: 6 / 8;
            background: #fff;
            height: 500px;
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
            box-sizing: border-box;
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: repeat(10,auto);
            gap: 15px;
            margin-left: 5px;
            margin-right: 5px;
        }

        .main-container.logged-out .post {
            display: none;
        }

        .main-container.logged-out .content {
            grid-column: 1 / 6;
        }

        .recent {
            padding-top: 20px;
        }       
    @media (max-width: 400px) {

        .main-container {
            grid-template-rows: 100px 200px auto;
            grid-template-columns: repeat(7,1fr);
            gap: 15px;
            padding-left:0;
            padding-right:0;
            padding-top:0;
        }
        .main-container .trending {
            display: none;
        }

        .post {
            grid-column: 1 / 8;
            grid-row: 2 / 3;
            margin-right: 10px;
        }
        .main-container .content {
            grid-column: 1 / 8;
            grid-row: 3 / 4;
        }
        .main-container .heading h3.large {
            display: none;
        }
        .main-container .heading h3.small {
            display: contents;
        }
    }
    
    @media (min-width:400px) and (max-width: 850px) {
        <?php
            session_start();
            if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in']) {
                echo '
                .main-container {
                    grid-template-rows: 100px 200px auto;
                    grid-template-columns: repeat(7,1fr);
                    gap: 15px;
                    padding-left:0;
                    padding-right:0;
                    padding-top:0;
                }

                .post {
                    display: grid;
                    grid-column: 2 / 7;
                    grid-rows: 2 / 3;
                }
                .post form {
                    grid-row: 1 / 4;
                    grid-column: 1 / 8;
                }
                .post form textarea {
                    border-radius: 5px;
                    height: 100px;
                    width: 100%;
                    box-shadow: 0px 0px 3px 1px #33333323;
                    font-size: large;
                }

                .main-container .trending {
                    display: none;
                }

                .main-container .content {
                    grid-column: 1 / 8;
                    grid-row: 3 / 4;
                }
                ';
            } else {
                echo '
                .main-container .post {
                    display: none;
                }

                .main-container .content, .main-container.logged-out .content {
                    grid-column: 1 / 8;
                }
                
                ';
            }
        ?>

        .main-container .trending {
            display: none;
        }

        .main-container .heading h3.large {
            display: none;
        }

        .main-container .heading h3.small {
            display: contents;
        }

    }
    @media (min-width: 851px) {
        .trending h4 {
            padding: 10px;
            border-bottom: none;
        }
        .content {
            margin-top: 0;
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
                        <li><a class="active-page" href="./buzz.php">Buzz</a></li>
                        <li><a href="./club.php">Club</a></li>
                        
                        <?php
                            if ($class === 'logged-in') {
                                echo '
                                <li><a href="./profile.php">Profile</a></li>
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
                    unset($_SESSION['message']);
                }
            ?>
        </header>
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
                <form action="post.php" method="post">
                    <div class="post-input">
                        <textarea id="content" name="content" placeholder="What\'s happening?"></textarea><br>
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
                <?php 
                loadPosts(); ?>
                <!-- Example post 
                <div class="item-wrap">
                    <div class="item">
                        <img src="../../assets/images/peter.jpg" alt="User Name">
                        <div>
                            <h3>Peter Griffin</h3>
                            <p>Buzz test</p>
                        </div>
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
</script>
</body>
</html>

<?php
if (isset($_SESSION['message']) && $_SESSION['message'] === 'Logout successful!') {
    unset($_SESSION['message']);
}
?>