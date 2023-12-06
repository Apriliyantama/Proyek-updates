<?php

$host="localhost";
$user="root";
$password="";
$db="user"; 

session_start();

$data= mysqli_connect($host,$user,$password,$db);
if($data === false)
{
    die("connection error");
}


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = mysqli_real_escape_string($data, $_POST["username"]);
    $password = mysqli_real_escape_string($data, $_POST["password"]);

    $sql="SELECT * FROM login WHERE username= '$username' AND password= '$password' ";
    $result=mysqli_query($data, $sql);


    if($result) {
        $row=mysqli_fetch_assoc($result);

        if ($row) {
            $usertype = $row["usertype"];

            if ($usertype == "user") {
            
                $_SESSION["username"]=$username;
                header("location:homeuser.php");
            
            } elseif ($usertype == "admin") {
                
                $_SESSION["username"]=$username;
                header("location:homeadmin.php");
            
            } else {
                echo "Invalid usertype";
            }
        } else {
            echo "Username or password incorrect";
        }
    } else {
        echo "Query error: " . mysqli_error($data);
    }

    mysqli_close($data);

}
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<center>
        <h1>Login</h1>
            <form action="#" method="POST">
    <div>
        <label>Username</label>
        <input type="text" name="username" required>
    </div>
    <br>
    <div>
        <label>Password</label>
        <input type="password" name="password" require>
    </div>

    <div>
        <input type="submit" value="login">
    </div>
    </form>
</center>
    
</body>
</html>