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
            <img src="img/jk5.png">
                
                <div class="slider-caption">
                
                 <p>  </p>
                    <h1>Orders</h1>
                </div>
            </div>
            
        </div>
            
    </div>
        <div class="controls">
                <i class="bi bi-chevron-left prev"></i>
                <i class="bi bi-chevron-right next"></i>
            </div>
    </div>
    

    <section class="form-container2">
        <?php
                        if(isset($message)){
                            foreach($message as $message) {
                                echo '
                                    <div class="message">
                                        <span>'.$message.'</span>
                                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                                    </div>
                                ';

                            }
                        }

        ?>
        
    <div class="box-container">
        

        
    
        <?php
            $select_products=mysqli_query($conn,"SELECT * FROM `cart` 
            LEFT JOIN `products` ON cart.product_id = products.product_id 
            WHERE user_id='$user_id'  
            ORDER BY cart_id DESC") or die('query faileda');
            
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products= mysqli_fetch_assoc($select_products)){
        ?>


    <div class="box">
    <form method="post" action="payment.php">
            
    <img src="img/<?php echo $fetch_products['image']; 
                            ?>
                 ">

                
                <h4><br><?php echo $fetch_products['name']; ?></h4>
                <h4>Total Price: <?php echo $fetch_products['amount']; ?> Taka</h4>
                <details>
                    Total Quantity: <?php echo $fetch_products['cart_quantity']; ?><br>
                    
                    Payment Status: <?php echo $fetch_products['payment_status']; ?><br>
                    Delivery Address: <?php echo $fetch_products['delivery_address']; ?><br>
                </details>

                <input type="hidden" name="amount" value="<?php echo $fetch_products['amount'];?>">
                <input type="hidden" name="cart_id" value="<?php echo $fetch_products['cart_id'];?>">
                
                
                <?php if (($fetch_products['payment_status'] == 'Cash On Delivery') 
                && ($fetch_products['order_status'] != 'Delivery Complete')): ?>

                    <button type="submit" name="payment_now" class="btn2" onclick="return confirm('Want to Payment Online?')">
                        Payment Online
                        <a href="payment.php?payment=<?php echo $fetch_products['cart_id']; ?>"></a>
                    </button>
                <?php elseif (($fetch_products['order_status'] == 'Delivery Complete')): ?>
                    <button type="button" class="btn" disabled>
                    Delivery Complete
                    </button>
                <?php else: ?>
                    <button type="button" class="btn" disabled>
                        Payment Done
                    </button>
                <?php endif; ?>

                        
                </button>

            </form>
        </div>

        <?php
                }
            } else {
                echo '
                    <div class="empty">
                        <p>no products added yet!</p>
                    </div>
                ';
            }

            
        ?>
        
    </div>
</section>







    

    
    


    
    <?php include 'footer.php';?>
    <!--------------slick slider link---------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type= "text/javascript" src="main.js"></script>

    
</body>
</html>