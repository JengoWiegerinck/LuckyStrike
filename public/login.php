<?php
require_once "header.php";
require_once "../source/db_user.php";

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUser($email, $password);

    if($user == "No user found!")
    {
        echo '<script>alert("Dit is niet de goede combinatie")</script>';
    }else
    {
        setcookie("CurrUser", (new user($user))->getId(), time() + 3600, "/", "");
        header('location: ../index.php');
    }
}
?>

<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@600;700&family=Open+Sans:wght@500;600;800&family=Rubik:wght@500&display=swap" rel="stylesheet">

    <script>
        function alert()
        {
            <?php
            if(!empty($login_err)){
                ?>
                alert($login_err);
            <?php
            }
            ?> 
            
        }
    </script>
</head>

    <div class="container">
        <form action="" method="post">
            <div >
                <h3>Email</h3>
                <input type="email" name="email" value="" required>
            </div>

            <div >
                <h3 class="titleh3">Wachtwoord</h3>
                <input type="password" name="password" required>
            </div>

            <div >
                <input type="submit" value="Login" name="submit">
            </div>

            <p>Nog geen account? <a href="signUp.php">Registreer nu</a>.</p>
        </form>
    </div>  
</body>


</html>


<?php
require_once "footer.php";
?>