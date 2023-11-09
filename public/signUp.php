<?php
require_once "header.php";
require_once "../source/db_user.php";

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


        if(checkEmail($email) == "No user found!")
        {
            $insertedId = insertUser($username, $email, $password);
        }else{
            echo '<script>alert("Er is al een account voor dit email")</script>';
        }
        

    if ($insertedId > 0) {
        setcookie("CurrUser", $insertedId, time() + 3600, "/", "");
        header('location: index.php');
        exit();
    }
}

?>

<html>
<head>
</head>
<body>  
    <div class="container">
        <div class="login"> 
            <form action="" method="post">
                <div>
                    <h3>Gebruikersnaam</h3>
                    <input type="text" name="username" value="" required>
                </div>   
                <div>
                    <h3>Email</h3>
                    <input type="email" name="email" value="" required>
                </div>  
                <div>
                    <h3  class="titleh3">Wachtwoord</h3>
                    <input type="password" name="password" value="" required>
                </div>
                <div>
                <div>
                    <input type="submit" value="Verzenden" name="submit">
                </div>
                <p>Heb je al een account? <a href="login.php" class="linkColorText">Login hier</a>.</p>
            </form>
        </div>
    </div>    
</body>
</html>

<?php
require_once "../footer.php";
?>