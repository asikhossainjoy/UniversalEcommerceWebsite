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
<style type = "text/css">
    <?php
        include 'main.css';
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
    <?php include 'header.php';?>
    <!--------------home slider---------------------->
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="img/pay.png">
                <div class="slider-caption">
                <?php
                        $edit_id = (isset($_POST['cart_id'])) ? $_POST['cart_id'] : 0; 
                        $amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;
                ?>
                    
                    <h1>Payable Amount : <?php echo $amount; ?></h1>
                    <h1>Want to Payment Online?</h1>
                    
                    <p>Payment With Cash, BKash, Nagad, Visa, Master Card<br>
                    
                    </p>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/bkash2.png">
                <div class="slider-caption">
                <?php
                        $edit_id = (isset($_POST['cart_id'])) ? $_POST['cart_id'] : 0; 
                        $amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;
                ?>
                    <h1>Bkash</h1>
                    <h1>Payable Amount : <?php echo $amount; ?></h1><p></p>
                    <a href="bkash.php?cart_id=<?php echo $edit_id ?>&amount=<?php echo $amount ?>" class="btn">Payment With Bkash</a>

                </div>
            </div>
            <div class="slider-item">
                <img src="img/nagad2.png">
                <div class="slider-caption">
                <?php
                        $edit_id = (isset($_POST['cart_id'])) ? $_POST['cart_id'] : 0; 
                        $amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;
                ?>
                    <h1>Nagad</h1>
                    <h1>Payable Amount : <?php echo $amount; ?></h1><p></p>
                    
                    <a href="nagad.php?cart_id=<?php echo $edit_id ?>&amount=<?php echo $amount ?>" class="btn">Payment With Nagad</a>

                </div>
            </div>
            <div class="slider-item">
                <img src="img/card.png">
                <div class="slider-caption2">
                <?php
                        $edit_id = (isset($_POST['cart_id'])) ? $_POST['cart_id'] : 0; 
                        $amount = (isset($_POST['amount'])) ? $_POST['amount'] : 0;
                ?>
                    <h1>Visa & Master Card</h1>
                    <h1>Payable Amount : <?php echo $amount; ?></h1><p></p>
                    <a href="card.php?cart_id=<?php echo $edit_id ?>&amount=<?php echo $amount ?>" class="btn">Payment With Bank Card</a>
                </div>
            </div>
            
            
        </div>
        <div class="controls">
                <i class="bi bi-chevron-left prev"></i>
                <i class="bi bi-chevron-right next"></i>
            </div>
    </div>

    
    <div class="line4"></div>

    <?php include 'footer.php';?>
    <!--------------slick slider link---------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type= "text/javascript" src="main.js"></script>

    
</body>
</html>