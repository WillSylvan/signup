<?php 

    include ('assets/connect.php');
    include ('assets/function.php');

    
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/index.css">
		<link rel="stylesheet" type="text/css" href="style/style.css">
    </head>

    <body>
        <div>
            <div class="sign_up">
                <h1> SIGN UP <h1>
            </div>

            <form action="index.php" method="post" class="signup_form">

                <input type="text" name="f_name" placeholder="FIRSTNAME" height><br>
                <input type="text" name="l_name" placeholder="LASTNAME"><br>
                <input type="text" name="email" placeholder="EMAIL"><br>
                <input type="text" name="age" placeholder="EMAIL"><br>
                <input type="text" name="pass" placeholder="PASSWORD"><br>
                <input type="text" name="repass" placeholder="RE_PASSWORD"><br>

                <input type="submit" placeholder="SIGN UP" value="post">
            </form>

            <div class= "forger_pass">
                <button>forget password?</button>
            </div>
</div>
    </body>
</html>