<?php
     include 'connection.php';

     if(isset($_POST['submit-btn'])){
        $filter_fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
        $fname= mysqli_real_escape_string($conn, $filter_fname);

        $filter_lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
        $lname= mysqli_real_escape_string($conn, $filter_lname);

        $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $email= mysqli_real_escape_string($conn, $filter_email);

        $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $password= mysqli_real_escape_string($conn, $filter_password);

        $filter_cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
        $cpassword= mysqli_real_escape_string($conn, $filter_cpassword);

        /*$select_user = mysqli_query($conn, "SELECT * FROM 'users' WHERE email = '$email'") or die('die Asik');*/
        $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email'") or die('die Asik');

        if(mysqli_num_rows($select_user)>0){
            $message[] = 'user already exist';
        }else{
            if($password != $cpassword){
                $message[] = 'password and re-password are not same';
            }else{
                /*mysqli_query($conn, "INSERT INTO 'users'('name','email','password')VALUES('$name','$email','$password')") or die('query failed');*/
                mysqli_query($conn, "INSERT INTO users(first_name,last_name,email,password)VALUES('$fname','$lname','$email','$password')") or die('query failed');
                $message[] ='registed successfully';
                header('location:login.php');
            }
        }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---box icon link--->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="stylemain2.css">
    <title>Register Page</title>
</head>
<body>
    

<section class="form-container">
    <?php
    if(isset($message)){
        foreach($message as $msg) {
            echo '
                <div class="message">
                    <span>'.$msg.'</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
            ';
        }
    }
    ?>
    <form method="post">
    <h1>register now</h1>
    <input type="text" name="fname" placeholder="enter your first name" required value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>">
    <input type="text" name="lname" placeholder="enter your last name" required value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''; ?>">
    <input type="email" name="email" placeholder="enter your email" required value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
    <input type="password" name="password" placeholder="enter your password" required value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
    <input type="password" name="cpassword" placeholder="confirm your password" required value="<?php echo isset($_POST['cpassword']) ? $_POST['cpassword'] : ''; ?>">

        <input type="submit" name="submit-btn" value="register now" class="btn">
        <p>already have an account ? <a href="login.php">login now</a></p>
    </form>
</section>

</body>
</html>