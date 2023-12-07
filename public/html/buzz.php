<?php
function loadPosts() {
    $host = 'localhost'; // or your database host
    $db   = 'blugoldBuzz';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    // SQL to count the number of rows in a table
    $sql = "SELECT COUNT(*) FROM post";

    try {
        // Executing the query
        $stmt = $pdo->query($sql);

        // Fetching the result
        $count = $stmt->fetchColumn();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }




    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'blugoldbuzz';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $table = 'post'; // replace with your table name
    $column1 = 'username'; // replace with your column name
    $column2 = 'content'; // replace with your column name

    

    

    for($i=1; $i<$count+1; $i++){
        

        $sql = "SELECT $column1 FROM $table WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $count); // "i" is for integer. Use "s" for string, etc.
        $stmt->execute();
        $result = $stmt->get_result();

        if ($item1 = $result->fetch_assoc()) {
            
        } else {
            echo "No record found.";
        }


        $sql = "SELECT $column2 FROM $table WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $count); // "i" is for integer. Use "s" for string, etc.
        $stmt->execute();
        $result = $stmt->get_result();

        if ($item2 = $result->fetch_assoc()) {
            
        } else {
            echo "No record found.";
        }

        echo $item1[0];

        echo "<div class='post'>";
        echo "<img src='../../assets/images/cleveland.png' alt='User Name'>";
        echo "<div><h3>h</h3>";
        echo "<p>h</p></div>";
        echo "</div>";
    }

    $stmt->close();
    $conn->close();
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
                        <li><a href="./club.php">Club</a></li>
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