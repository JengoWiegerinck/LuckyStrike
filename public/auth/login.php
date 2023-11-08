<?php
require_once "../header.php";
require_once "../../source/db_user.php";

if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUser($email, $password);

    if($user == "No user found!")
    {
        echo '<script>alert("Er is al een account voor dit email")</script>';
    }else
    {
        setcookie("CurrUser", (new user($user))->getId(), time() + 3600, "/", "");
        header('location: ../Activities/overview.php');
    }
}
?>

<html>
<head>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">  -->
    <link rel="stylesheet" href="../../Css/login.css">
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
<body>   
    <div class="container">

                    <!-- <label>Username</label> -->
                    <h3>Email</h3>
                    <input type="email" name="email" class="form-control" value="" required>
                </div>    
                <div class="form-group">
                    <!-- <label>Password</label> -->
                    <h3 class="titleh3">Wachtwoord</h3>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" value="Login" name="submit" onclick="alert();">
                </div>
                <p>Nog geen account? <a class="linkColorText" href="signUp.php">Registreer nu</a>.</p>
                
            </form>
        </div>
    </div>  
</body>


</html>


<?php
require_once "../footer.php";
?>