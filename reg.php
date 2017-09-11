<?php 

    include ('assets/connect.php');
    include ('assets/function.php');

    $error_message_fn = "";
    $error_message_fn2 = "";
    $error_message_fn3 = "";
    $error_message_ln = "";
    $error_message_ln2 = "";
    $error_message_ln3 ="";
    $error_message_em = "";
    $error_message_age = "";
    $error_message_age2 = "";
    $error_message_pass = "";
    $error_message_pass2 = "";
    $error_message_pass3 = "";

    $trueError = false;

    $errors = ['f_name'=>0,'l_name'=>0,'email'=>0, 'age'=>0, 'pass'=>0, 're_pass'=>0];

    $error = "";
    
    if(isset($_POST["submit"])){

        $f_name = $_POST["f_name"];
        $l_name = $_POST["l_name"];
        $email = $_POST["email"];
        $age = $_POST["age"];
        $password = $_POST["pass"];
        $re_pass = $_POST["re_pass"];
        $date = date('Y-m-d H:i:s');

        $error_message_fn = "";
        $error_message_fn2 = "";
        $error_message_fn3 = "";
        $error_message_ln = "";
        $error_message_ln2 = "";
        $error_message_ln3 ="";
        $error_message_em = "";
        $error_message_age = "";
        $error_message_age2 = "";
        $error_message_pass = "";
        $error_message_pass2 = "";
        $error_message_pass3 = "";

        $errors = ['f_name'=>0,'l_name'=>0,'email'=>0, 'age'=>0, 'pass'=>0, 're_pass'=>0];

        $email_exp_a = "/[^A-Za-z]/";

        $email_exp_n = "/[^0-9]/";
// -------------------------------------------- >>>
        


        // FIRST NAME
        if (empty($f_name)) {
            $trueError = true;
            $error_message_fn .= '<p style = "color: red;">Please enter place.</p>';
            $errors['f_name'] = 1;
        }

		if(preg_match($email_exp_a, $f_name)) {
            $trueError = true;
			$error_message_fn2 .= '<p style = "color: red;">only alphabet!</p>';
			$errors['f_name'] = 1;
		}

        if(strlen($f_name) < 2){
            $trueError = true;
			$error_message_fn3 .= '<p style = "color: red;">Name of place is too short.</p>';
			$errors['f_name'] = 1;
        }

// -------------------------------------------- >>>

        // FIRST NAME
        if (empty($l_name)) {
            $trueError = true;
            $error_message_ln .= '<p style = "color: red;">Please enter place.</p>';
            $errors['l_name'] = 1;
        }

		
		if(preg_match($email_exp_a, $l_name)) {
            $trueError = true;
			$error_message_ln2 .= '<p style = "color: red;">only alphabet!</p>';
			$errors['l_name'] = 1;
		}

        if(strlen($l_name) < 2){
            $trueError = true;
			$error_message_ln3 .= '<p style = "color: red;">Name of place is too short.</p>';
			$errors['l_name'] = 1;
        }


// -------------------------------------------- >>>

        // EMAIL 
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

        if(!preg_match($email_exp, $email)) {
            $trueError = true;
            $error_message_em .= '<p style = "color: red;">Please enter email!</p>';
            $errors['email'] = 1;
        }


// ------------------------------------------- >>>

        // AGE
        if (empty($age)) {
            $trueError = true;
            $error_message_age .= '<p style = "color: red;">Please enter place.</p>';
            $errors['age'] = 1;
        }

		if(preg_match($email_exp_n, $age)) {
            $trueError = true;
			$error_message_age2 .= '<p style = "color: red;">only numbers!</p>';
			$errors['age'] = 1;
        }
        
// ------------------------------------------ >>>


        // password validation
        if (empty($pass)){
            $trueError = true;
            $error_message_pass .= '<p style = "color: red;">Please enter password.</p>';
            $errors['pass'] = 1;
        }
        
        if(strlen($password) < 8) {
            $trueError = true;
            $error_message_pass2 .= '<p style = "color: red;">Mininum 8 latters</p>';
			$errors['pass'] = 1;
        }

        if($password !== $re_pass){
            $trueError = true;
            $error_message_pass3 .= '<p style = "color: red;">Password Dont match!</p>';
			$errors['pass'] = 1;
        }

        if(!$trueError){
            $sql = "INSERT INTO `signup`(`id`, `firstname`, `lastname`, `email`, `age`, `password`) VALUES(:firstname, :lastname, :email, :age, :password)";

            $row = insertDataInToDataBase($sql, [
                'firstname' => $f_name,
                'lastname' => $l_name,
                'email' => $email,
                'age' => $age, 
                'password' => hashPass($password),
            ]);

            $error = "You are successfully registered";
        }

// ---------------------------------------- >>>

        if (!$trueError) {

            $qe = "SELECT id FROM signup WHERE email=:email AND date =:date";

            $pay['email'] = $email;
            $pay['date'] = $date;
            $getID = getDataFromDatabase($qe,$pay);
            $_SESSION['uid'] = $getID['id'];
            print_r( $_SESSION['uid']);
            $link = $SiteUrl."index.php";
            header('location:'.$link);
            exit;

        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style/index.css">
		<link rel="stylesheet" type="text/css" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tammudu|Lobster|Russo+One" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Baloo+Tammudu|Lobster" rel="stylesheet">
    </head>

    <body>
        <div>
            <div class="sign_up">
                <h1> SIGN UP <h1>
            </div>

            <div class="top-error">
                <?php echo ($error); ?>
            </div>

            <form action="reg.php" method="post" class="signup_form">

                <input type="text" name="f_name" value = "<?php if(isset($_POST['f_name']) && $errors['f_name'] == 0){ echo $_POST['f_name']; } ?>" placeholder="FIRSTNAME" height><br>
                    <!--ERRROR  -->
                    <div class = "input-error">
                        <?php echo ($error_message_fn); ?>
                        <?php echo ($error_message_fn2); ?>
                        <?php echo ($error_message_fn3); ?>
                    </div>
                    <!--END-->

                <input type="text" name="l_name" value = "<?php if(isset($_POST['l_name']) && $errors['l_name'] == 0){ echo $_POST['l_name']; } ?>" placeholder="LASTNAME"><br>
                    <!--ERRROR  -->
                    <div class = "input-error">
                        <?php echo ($error_message_ln); ?>
                        <?php echo ($error_message_ln2); ?>
                        <?php echo ($error_message_ln3); ?>
                    </div>
                    <!--END-->

                <input type="text" name="email" value = "<?php if(isset($_POST['email']) && $errors['email'] == 0){ echo $_POST['email']; } ?>" placeholder="EMAIL"><br>
                    <!--ERRROR  -->
                    <div class = "input-error">
                        <?php echo ($error_message_em); ?>
                    </div>
                    <!--END-->
                
                <input type="text" name="age" value = "<?php if(isset($_POST['age']) && $errors['age'] == 0){ echo $_POST['age']; } ?>" placeholder="AGE"><br>
                    <!--ERRROR  -->
                    <div class = "input-error">
                        <?php echo ($error_message_age); ?>
                        <?php echo ($error_message_age2); ?>
                    </div>
                    <!--END-->

                <input type="text" name="pass" value = "<?php if(isset($_POST['pass']) && $errors['pass'] == 0){ echo $_POST['pass']; } ?>" placeholder="PASSWORD"><br>
                    <!--ERRROR  -->
                    <div class = "input-error">
                        <?php echo ($error_message_pass); ?>
                        <?php echo ($error_message_pass2); ?>
                    </div>
                    <!--END-->
                
                <input type="text" name="re_pass" value = "<?php if(isset($_POST['re_pass']) && $errors['re_pass'] == 0){ echo $_POST['re_pass']; } ?>" placeholder="RE_PASSWORD"><br>
                    <!--ERRROR  -->
                    <div class = "input-error">
                        <?php echo ($error_message_pass3); ?>
                    </div>
                    <!--END-->

                <input type="submit" name= "submit" placeholder="SIGN UP" value="submit">
            </form>

            <div class= "forger_pass">
                <button>forget password?</button>
            </div>
        </div>
    </body>
</html>