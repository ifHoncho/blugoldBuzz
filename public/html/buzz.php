<?php


function loadPosts() {
    $posts = [
        // Example posts data
        ["title" => "First Post", "content" => "This is a dynamic post."],
        ["title" => "Second Post", "content" => "This is a dynamic post."],
        // Add more posts here
    ];

    foreach ($posts as $post) {
        echo "<div class='post'>";
        echo "<img src='../../assets/images/cleveland.png' alt='User Name'>";
        echo "<div><h3>" . htmlspecialchars($post['title']) . "</h3>";
        echo "<p>" . htmlspecialchars($post['content']) . "</p></div>";
        echo "</div>";
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
                        <li><a href="../css/index.php" class="active">Home</a></li>
                        <li><a href="../css/buzz.php">Buzz</a></li>
                        <li><a href="./club.php">Club</a></li>
                        <li><a href="./about.html">About</a></li>
                        <li><a href="./accountSettings.html">Account</a></li>
                    </ul>
                </div>
            </div>
            <div class="dropdown">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <script>
            var dropDown = document.querySelector(".dropdown");
            var menu = document.querySelector(".menu");

            dropDown.addEventListener("click", function () {
                menu.classList.toggle("active");
            })
        </script>
        <div class="pcontainer">
            <div class="pmain">
                <section class="post-box">
                    <textarea placeholder="What's happening?"></textarea>
                    <button>Post</button>
                </section>


                <div class="feed">
                    <?php 
                    loadPosts(); ?>
                    <!-- Example post -->
                    <div class="post">
                        <img src="../../assets/images/peter.jpg" alt="User Name">
                        <div>
                            <h3>Peter Griffin</h3>
                            <p>Buzz test</p>
                        </div>
                    </div>

                    <div class="post">
                        <img src="../../assets/images/cleveland.png" alt="User Name">
                        <div>
                            <h3>Cleveland Brown</h3>
                            <p>Hello</p>
                        </div>
                    </div>
                    <!-- More posts would be listed here -->

                </div>
            </div>
        </div>
        <footer>
            © 2023 Your Website. All rights reserved.
        </footer>
        <script>
            /*
            async function loadPosts(numberOfPosts) {
                try {
                    // Fetch the data from the API
                    //const response = 
                    //const posts = await response.json();

                    // Generate HTML for each post
                    let postsHTML = '';
                    for (let i = 0; i < numberOfPosts; i++) {
                        postsHTML += `
                        <div class="post">
                            <img src="../../assets/images/defaultProfile.jpg" alt="User Name">
                            <div>
                                <h3>Cleveland Brown</h3>
                                <p>Hello</p>
                            </div>
                        </div>`;
                    };

                    // Insert the HTML into your webpage
                    document.getElementsByClassName('feed').innerHTML[0] += postsHTML;
                } catch (error) {
                    console.error('Error fetching posts:', error);
                }
            }
            //loadPosts(5);
            */
        </script>
</body>

</html>
