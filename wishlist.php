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
    if(isset($_POST['deletew'])){
        
        $delete_id = $_POST['wish_id'];
        

        mysqli_query($conn, "DELETE FROM `wishlist` WHERE `wish_id` = '$delete_id'") or die('query failed6');
    }

    //adding products to database
    if(isset($_POST['buy_now']) ){


        //product_id full_name phone_number delivery_address cart_quantity
        echo 'hello';
        $product_wish_id= mysqli_real_escape_string($conn, $_POST['wish_id']);
        $product_price= mysqli_real_escape_string($conn, $_POST['price']);
        $product_cart_quantity= mysqli_real_escape_string($conn, $_POST['cart_quantity']);
        echo $full_name;
        $product_id= mysqli_real_escape_string($conn, $_POST['product_id']);
        $full_name= mysqli_real_escape_string($conn, $_POST['full_name']);
        $product_phone_number= mysqli_real_escape_string($conn, $_POST['phone_number']);
        $product_delivery_address= mysqli_real_escape_string($conn, $_POST['delivery_address']);
        $product_quantity= mysqli_real_escape_string($conn, $_POST['product_quantity']);

        $product_quantity2=$product_quantity-$product_cart_quantity;

        $amount = $product_price*$product_cart_quantity;

        $insert_product = mysqli_query($conn, "INSERT INTO `cart` (`user_id`,`product_id`,`cart_quantity`,`full_name`,`phone_number`, `delivery_address`,`amount`)
                VALUES('$user_id','$product_id','$product_cart_quantity','$full_name','$product_phone_number','$product_delivery_address','$amount ')") or die('query failed');


        $update_query = mysqli_query($conn, "UPDATE `products` SET `product_quantity`='$product_quantity2' WHERE  product_id='$product_id'")or die('query failed');

        mysqli_query($conn, "DELETE FROM `wishlist` WHERE `wish_id` = '$product_wish_id'") or die('query failed6');      

        header('location:order.php');
        
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
            <img src="img/fh.png">
                
                <div class="slider-caption">
                

                    <h1>WishList</h1>
                </div>
            </div>
            
        </div>
            
    </div>
        <div class="controls">
                <i class="bi bi-chevron-left prev"></i>
                <i class="bi bi-chevron-right next"></i>
            </div>
    </div>
    

    <section class="form-container1">
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
            $select_products=mysqli_query($conn,"SELECT * FROM `wishlist` RIGHT JOIN `products`
            ON wishlist.product_id = products.product_id where user_id='$user_id' order by wish_id desc
            ") or die('query faileda');
            
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products= mysqli_fetch_assoc($select_products)){
        ?>


    <div class="box">
    <form method="post" action="wishlist.php">
            
    <img src="img/<?php echo $fetch_products['image']; 
                            ?>
                 ">

                
                <h4><br><?php echo $fetch_products['name']; ?></h4>
                <h4>Price: <?php echo $fetch_products['price']; ?> Taka</h4>
                <p>Quantity: <?php echo $fetch_products['product_quantity']; ?></p>
                <details>
                    
                    Category: <?php echo $fetch_products['category']; ?><br>
                    Description: <?php echo $fetch_products['detail']; ?><br>
                </details>

                <input type="hidden" name="wish_id" value="<?php echo $fetch_products['wish_id'];?>">
                
                
                <div class="icon">
                <a href="wishlist.php?cart=<?php echo $fetch_products['wish_id']; ?>" class="bi bi-cart" onclick="return confirm('Want to cart this product?');"></a>
                    <button type="submit" name="deletew" onclick="return confirm('Want to remove this product from wishlist?')">
                        <i class="bi bi-trash"></i> 
                    </button>
                </div>
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


<section class="update-container">



        <?php
        
            if(isset($_GET['cart'])) {
                $edit_id = $_GET['cart'];
                $edit_query =mysqli_query($conn,"SELECT * FROM `wishlist` RIGHT JOIN `products`
                ON wishlist.product_id = products.product_id where wishlist.wish_id='$edit_id'
                ")or die('query failed');
                $edit_query2 =mysqli_query($conn,"SELECT * FROM `wishlist` where wish_id='$edit_id'
                ")or die('query failed');
                $fetch_edit2 = mysqli_fetch_assoc($edit_query2);
                if(mysqli_num_rows($edit_query)>0){
                    while($fetch_edit = mysqli_fetch_assoc($edit_query)){

                    
                //}
           // }
        ?>
        <form method="POST" enctype="multipart/form-data">
        <h1>Delivery Product And Customer Information</h1><br>
        
            <img src="img/<?php echo $fetch_edit['image'];?>">
            

            <h4><br><?php echo $fetch_edit['name']; ?></h4>
                <h4>Price: <?php echo $fetch_edit['price']; ?> Taka</h4>
                <p>Quantity: <?php echo $fetch_edit['product_quantity']; ?></p>
                <details>
                    
                    Category: <?php echo $fetch_edit['category']; ?><br>
                    Description: <?php echo $fetch_edit['detail']; ?><br>
                </details><br>

                

                
                
            <input type="hidden" name="wish_id" value="<?php echo $fetch_edit2['wish_id'];?>">
            <input type="hidden" name="product_id" value="<?php echo $fetch_edit2['product_id'];?>">
            <input type="hidden" name="price" value="<?php echo $fetch_edit['price'];?>">
            <input type="hidden" name="product_quantity" value="<?php echo $fetch_edit['product_quantity'];?>">

            <p style="margin-left: -76%;">Required Quantity: </p>
            <input type="number" name="cart_quantity" min="1" max="<?php echo $fetch_edit['product_quantity']; ?>">
            <p>------------------------Customer Information------------------------</p>
            <p style="margin-left: -86%;">Full Name: </p>
            <input type="text" name="full_name" value="<?php echo $user_id2;?>">
            <p style="margin-left: -82%;">Phone Number: </p>
            <input type="text" name="phone_number"  >
            <p style="margin-left: -80%;">Delivery Address: </p>
            <textarea name="delivery_address" required></textarea>
            
            
            <button type="submit" name="buy_now" class="btn2"  onclick="return confirm('Want to buy this product?')">
            <i class="bi bi-cart-fill"></i>  Buy Now
            </button>
            <input type="reset" value="Cancel" class="btn2"  class="btn2" id="go-back" onclick="window.history.back(); ">
        </form>
        <?php 
                    }
                }
                echo "<script>document.querySelector('.update-container').style.display='block'</script>";
                
            }
        ?> 

    </section>
    <div class="line4"></div>




    

    
    


    
    <?php include 'footer.php';?>
    <!--------------slick slider link---------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type= "text/javascript" src="main.js"></script>

    
</body>
</html>