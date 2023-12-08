<?php
session_start();

$postsPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $postsPerPage;

// Create connection
$servername = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'blugoldbuzz';

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Gets posts
$sql = "SELECT id,post_date,content FROM post WHERE username = ? ORDER BY post_date DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);

$username = $_SESSION['username'];

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$bindResult = $stmt->bind_param("sii", $username, $postsPerPage, $offset);

if ($bindResult === false) {
    die("Error binding parameters: " . $stmt->error);
}

$executeResult = $stmt->execute();

if ($executeResult === false) {
    die("Error executing statement: " . $stmt->error);
}

$result = $stmt->get_result();

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

// Gets total number of posts
$sql = "SELECT COUNT(*) as count FROM post WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalPages = ceil($row['count'] / $postsPerPage);

// Gets user info
$sql = "SELECT userType FROM userinfo WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result2 = $stmt->get_result();
$userType = $result2->fetch_assoc();
?>
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
        .main {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-container {
            min-height: 70vh;
            background: aliceblue;
        }
        .profile {
            width: 80%;
            margin: 10px auto;
            padding: 20px;
            max-width: 800px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile h1 {
            text-align: center;
            color: #333;
        }

        .posts {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: auto;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .post {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            background: #fff;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-wrap: break-word;
            word-wrap: break-word; 
        }

        .post p {
            margin: 0 0 10px;
            line-height: 1.6;
        }

        .post p:last-child {
            margin-bottom: 0;
        }

        .post .editbtn, .post .dltbtn{
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .post .editbtn {
            background-color: #4e73df;
        }

        .post button:hover {
            background-color: #2e2e2e;
        }

        h1 > span {
            color: #4F709C;
        }

        .post h3 {
            margin-top: 0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background: #4e73df;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }
        .pagination p {
            color: black;
            font-weight: bold;
            padding: 8px 16px;
            font-size: 16px;
        }

        .modal {
            display: none;
            justify-content: center;
            align-items: center;
            position: fixed;
            z-index: 1;
            left: 100;
            top: 100;
            width: 40%;
            height: 200px;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
        #editModal {
            top: 150px;
            left: 150px;
        }

        .modal-content {
            background-color: #2e2e2e;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
        }

        .modal-content h2 {
            margin-top: 0;
            color: #f44336;
        }

        .modal-content p {
            color: #f44336;
        }

        .modal-content button, .modal-content a {
            margin-top: 20px;
            padding: 10px 20px;
            border: none;
            background-color: #f44336;
            color: #fff;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .modal-content button:hover, .modal-content a:hover {
            background-color: #d32f2f;
        }

        .profile h2 {
            text-align: center;
            color: #333;
        }

        @media screen and (max-width: 600px) {
            .modal-content {
                width: 90%; /* Adjust this value as needed */
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
                        <li><a href="./buzz.php">Buzz</a></li>
                        <li> <a href="./club.php">Club</a></li>
                        <li><a  class="active-page" href="./profile.php">Profile</a></li>
                        <li><a href="./logout.php">Logout</a></li>
                        <li><a href="./accountSettings.php">Account</a></li>
                    </ul>
                </div>
            </div>
            <div class="dropdown">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <div class="main-container">
            <div class="profile">
                <h1>Welcome, <span> <?php echo $username; ?> </span></h1><br>
                <h2><?php echo $userType['userType']; ?></h2>
            </div>
            <div class="profile">
                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <h2>Delete Post</h2>
                        <p>Are you sure you want to delete this post?</p>
                        <a id="confirmDelete" href="deletePost.php">Confirm</a>
                        <button onclick="closeModal()">Cancel</button>
                    </div>
                </div>
                <h2>Your Posts: </h2><br>
                <div class="posts">
                    <?php foreach($posts as $post): ?>
                        <div class="post">
                            <p><?php echo $post['content']; ?></p><br><br>
                            <p>Posted on: <?php echo date('F j, Y', strtotime($post['post_date'])); ?></p>
                            <button class="editbtn" onclick="openEditModal('<?php echo $post['id']; ?>')">Edit</button>
                            <button class="dltbtn" onclick="openModal('<?php echo $post['id']; ?>')">Delete</button>

                            <div id="editModal" class="modal">
                                <div class="modal-content">
                                    <h2>Edit Post</h2>
                                    <form class="editForm" method="POST" action="editPost.php">
                                        <textarea name="content" id="content"></textarea>
                                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                        <button type="submit">Edit</button>
                                    </form>
                                    <button onclick="closeModal()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="profile">
                <div class="pagination">
                <?php if($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>
                    <p> Page
                    <?php echo $page; ?> of <?php echo $totalPages; ?>
                    </p>
                <?php if($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
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

        function openModal(id) {
            document.getElementById('deleteModal').style.display = 'flex';
            document.getElementById('confirmDelete').href = 'deletePost.php?id=' + id;
        }

        function openEditModal(id) {
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>

</html>