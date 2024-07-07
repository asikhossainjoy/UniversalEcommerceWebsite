<?php

    include 'connection.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if(!isset($admin_id)){
        header('location:login.php');
    }

    if(isset($_POST['logout'])) {
        session_destroy();
        header('location:login.php');
    }
    

    

    //updateing payment status
    if(isset($_POST['status_now'])){
        $order_id=$_POST['cart_id'];
        $update_order=$_POST['update_order'];
        mysqli_query($conn, "UPDATE `cart` SET order_status='$update_order' WHERE cart_id='$order_id'") or die('query failed');

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---box icon link--->
    <link rel="stylesheet": href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="stylemain2.css">
    <title>admin panel</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
        

        
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
        <div class="line5"></div>

        <!--<section class="admin-dashboard">
            <div class = "box-container">
                <div class = "box">
                    <h1>unread message</h1>
                </div>
            </div>
        </section>-->

        <section class="orders-container">
        <div class = "box-container">
                <div class = "box">
                    <h1>total order placed</h1>
                </div>
            </div>

        
            
            <div class="box-container">
        

        
    
        <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `cart` 
            LEFT JOIN `products` ON cart.product_id = products.product_id
            ORDER BY cart.cart_id DESC") or die('query faileda');
        
            
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products= mysqli_fetch_assoc($select_products)){
        ?>


    <div class="box">
    <form method="post" action="admin_order.php">
            
    <img src="img/<?php echo $fetch_products['image']; 
                            ?>
                 ">

                
                <h4><br><?php echo $fetch_products['name']; ?></h4>
                <h4>Total Price: <?php echo $fetch_products['amount']; ?> Taka</h4>
                
                <p>Phone Number: <?php echo $fetch_products['phone_number']; ?></p>
                <details>

                
                    Total Quantity: <?php echo $fetch_products['cart_quantity']; ?><br>
                    
                    Payment Status: <?php echo $fetch_products['payment_status']; ?><br>

                    <p>Name: <?php echo $fetch_products['full_name']; ?></p>
                    <p>Phone Number: <?php echo $fetch_products['phone_number']; ?></p>
                    <p>Delivery Address: <?php echo $fetch_products['delivery_address']; ?></p>
                </details>

                <form method="post">
                <select name="update_order">
                    <?php if ($fetch_products['order_status'] != 'Delivery Complete'): ?>
                        <option disabled selected><?php echo $fetch_products['order_status']; ?></option>
                        <option value="Incomplete">Incomplete</option>
                        <option value="Packing Done">Packing Done</option>
                        <option value="On The Way To Delivery">On The Way To Delivery</option>
                        <option value="Delivery Complete">Delivery Complete</option>
                    <?php else: ?>
                        <option disabled selected><?php echo $fetch_products['order_status']; ?></option>
                        <option value="Incomplete"  disabled>Incomplete</option>
                        <option value="Packing Done"  disabled>Packing Done</option>
                        <option value="On The Way To Delivery"  disabled>On The Way To Delivery</option>
                        <option value="Delivery Complete"  disabled>Delivery Complete</option>
                    <?php endif; ?>
                </select>


                <input type="hidden" name="amount" value="<?php echo $fetch_products['amount'];?>">
                <input type="hidden" name="cart_id" value="<?php echo $fetch_products['cart_id'];?>">
                
                
                <?php if ($fetch_products['order_status'] != 'Delivery Complete'): ?>
                    <button type="submit" name="status_now" class="btn2" onclick="return confirm('Want to buy this product?')">
                        Update Delivery Status
                        <a href="admin_order.php?payment=<?php echo $fetch_products['cart_id']; ?>"></a>
                    </button>
                <?php else: ?>
                    <button type="button" class="btn" disabled>
                        Delivery Done
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






        
    <script type="text/javascript" src="scriptmain2.js"></script>
</body>
</html>