<?php
function check_result($username, $password)
{
    $errors1 = array(); 
    $servername = "localhost";
    $dbuser = "root";
    $dbpass = "";

    $dbname = "blugoldbuzz";

    //disable mysqli error report
    mysqli_report(MYSQLI_REPORT_OFF);

    $conn = new mysqli($servername, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
        $conn->close();
        return "Database connect error";
    }

    $sql = "SELECT * FROM userinfo WHERE username = '$username';";
    $result = $conn->query($sql);

    if(!$result)
    {
        $conn->close();
        return "SQL operation error";
    }

    if($result->num_rows > 0)
    {
        $hashed_password = $result->fetch_assoc()["password"];
        
        if(password_verify($password, $hashed_password))
        {
            // Set a session variable to indicate a successful login
            $_SESSION['login_success'] = true;
            $_SESSION['user_logged_in'] = true;
            $conn->close();
            return true;
        }
        else
        {
            $_SESSION['user_logged_in'] = false;
            $errors1[] = "The password you entered is wrong!";
        }
    }
    else
    {
        $errors1[] = "Cannot match the username you entered!";
    }

    $conn->close();

    if (isset($errors1) && count($errors1) > 0) {
        return $errors1;
    }
    return true;
}
?>