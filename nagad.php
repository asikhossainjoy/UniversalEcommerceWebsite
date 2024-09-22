<?php

    include 'connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $user_id2 = $_SESSION['user_name'];

    if(!isset($user_id2)){
        header('location:login.php');
    }

    if(isset($_POST['logout'])) {
        session_destroy();
        header('location:login.php');
    }
    

    

?>
<?php

    include 'connection.php';

    

    $product_phone = '';
    $product_amount = '';
    $product_refererce = '';
    //adding products to database
    if(isset($_POST['add_product'])  ){ 
        //echo 'hello';
        $product_phone= mysqli_real_escape_string($conn, $_POST['phone']);
        $product_amount= mysqli_real_escape_string($conn, $_POST['amount']);
        $product_refererce= mysqli_real_escape_string($conn, $_POST['refererce']);
        $product_pin= mysqli_real_escape_string($conn, $_POST['pin']);
       
        

        if($product_pin=="5695"){
            $update_query = mysqli_query($conn, "UPDATE `cart` SET `payment_status`='Bkash' 
            WHERE  cart_id='$product_refererce'")or die('query failed');

                header('location:paymentsuccessfull.php');
                
                $message[] ='Payment Succesfull';
                $product_phone = "";
                $product_amount = '';
                $product_refererce = '';

                header('location:paymentsuccessfull.php');
        }else{
            $message[] ='Please enter correct pin';
        }
        
    }

    
?>
<style type = "text/css">
    <?php
        include 'nagad.css';
    ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--------------slick slider link---------------------->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <title>home page</title>
</head>
<body>

    <!--------------home slider---------------------->
    <div class="container-fluid">
                <img src="img/nagad4.png">
                
            
    </div>

    <section class="form-container1">
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '
                <div class="message">
                    <span>' . $msg . '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                </div>
            ';
        }
    }
    ?>

<form method="post" action="" enctype="multipart/form-data">

<?php
                    $edit_id = (isset($_GET['cart_id'])) ? $_GET['cart_id'] : 0; 
                    $amount = (isset($_GET['amount'])) ? $_GET['amount'] : 0;
?>

    <h1>Nagad Payment</h1>
    <div class="input-field">
        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" title="Please enter a 11-digit phone number" value="<?php echo htmlspecialchars($product_phone); ?>" required>
    </div>

    <div class="input-field">
        <label>Amount</label>
        <input type="text"  name="amount"  readonly value="<?php echo $amount; ?>" required>
    </div>

    <div class="input-field">
        <label>Reference</label>
        <input type="text" name="refererce" readonly value="<?php echo $edit_id; ?>" required>
    </div>

    <div class="input-field">
        <label>Nagad Pin</label>
        <input type="password" name="pin" required>
    </div>

    <input type="submit" name="add_product" value="Payment" class="btn">
</form>
</section>
    


    <!--------------slick slider link---------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type= "text/javascript" src="mainscript.js"></script>

    
</body>
</html>