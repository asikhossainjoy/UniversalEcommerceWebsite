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
    //adding products to database
    if(isset($_POST['add_product']) && isset($_FILES['image']) ){
        //echo 'hello';
        $product_name= mysqli_real_escape_string($conn, $_POST['name']);
        $product_price= mysqli_real_escape_string($conn, $_POST['price']);
        $product_quantity= mysqli_real_escape_string($conn, $_POST['quantity']);
        $product_category= mysqli_real_escape_string($conn, $_POST['category']);
        $product_detail= mysqli_real_escape_string($conn, $_POST['detail']);
        //$image= mysqli_real_escape_string($conn, $_POST['image']);
        $image= $_FILES['image']['name'];
        $image_size= $_FILES['image']['size'];
        $image_tmp_name= $_FILES['image']['tmp_name'];
        $image_folder= 'img/'.$image;

        //name, price, quantity, category, detail, image

        
            $insert_product = mysqli_query($conn, "INSERT INTO `products` (`name`,`price`,`detail`,`product_quantity`,`category`, `image`)
                VALUES('$product_name','$product_price','$product_detail','$product_quantity','$product_category','$image')") or die('query failed');
            if($insert_product){
                //echo 'hello1';
                if($image_size>2000000){
                    $message[]='image size is too large';
                }else{
                    //echo 'hello';
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[]='product added successfully';
                }
            }
        
    }

    //delete products from database
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $select_delete_image = mysqli_query($conn, "SELECT * FROM `products` WHERE product_id = '$delete_id'") or die('query failed');
        $feteh_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('image/'.$feteh_delete_image['image']);

        mysqli_query($conn, "DELETE FROM `products` WHERE product_id = '$delete_id'") or die('query failed');
        //mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
        //mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');

        header('location:admin_product.php');
    }

    //update product
    if(isset($_POST['updte_product'])){
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];

        $update_quantity = $_POST['update_quantity'];
        $update_category = $_POST['update_category'];

        $update_detail = $_POST['update_detail'];
        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'img/'.$update_image;

        
        


        

        if($update_image!=NULL){
            $update_query = mysqli_query($conn, "UPDATE `products` SET `product_id`='$update_id',
            `name`='$update_name',`price`='$update_price',`product_quantity`='$update_quantity',
            `category`='$update_category',
            `detail`='$update_detail',`image`='$update_image' WHERE  product_id='$update_id'")or die('query failed');
        }else{

        

            $update_query = mysqli_query($conn, "UPDATE `products` SET `product_id`='$update_id',
            `name`='$update_name',`price`='$update_price',`detail`='$update_detail',
            `product_quantity`='$update_quantity',
            `category`='$update_category'
             WHERE `product_id`='$update_id'")or die('query failed1');
        }
        if($update_query){
            move_uploaded_file($update_image_tmp_name,$update_image_folder);
            header('location:admin_product.php');
        }
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
        

        <!--<div class="line2"></div>
        <section class="add-products from-container">
            <from method="POST" action="" enctype="multipart/form-data">
                <div class="input-field">
                    <label>product name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="input-field">
                    <label>product price</label>
                    <input type="text" name="price" required>
                </div>
                <div class="input-field">
                    <label>product detail</label>
                    <textarea name="detail" required></textarea>
                </div>
                <div class="input-field">
                    <label>product image</label>
                    <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <input type="submit" name="add_product" value="add product">

            </form>

        </section>-->

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
        <form method="post" action="" enctype="multipart/form-data">
            <h1>add product</h1>
            <div class="input-field">
                        <label>product name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="input-field">
                        <label>product price</label>
                        <input type="number" min="0" name="price" step="1" required>
                    </div>
                    <div class="input-field">
                        <label>product quantity</label>
                        <input type="number" min="0" name="quantity" step="1" required>
                        <label>product category</label>
                    </div>
                    <select  name="category" required>
                        <option value="" disabled selected hidden>Select Product Category</option>
                        <option value="Fruits And Vegetables">Fruits & Vegetables</option>
                        <option value="Dairy And Eggs">Dairy & Eggs</option>
                        <option value="Meat And Seafood">Meat & Seafood</option>
                        <option value="Bakery And Bread">Bakery & Bread</option>
                        <option value="Frozen Foods And Drinks">Frozen Foods & Drinks</option>
                        <option value="Snacks And Sweets">Snacks & Sweets</option>
                        <option value="Others">Others</option>
                    </select>
                    <div class="input-field">
                        <label>product detail</label>
                        <textarea name="detail" required></textarea>
                    </div>
                    <div class="input-field">
                        <label>product image</label>
                        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                    </div>
                    <input type="submit" name="add_product" value="add product" class="btn">

            </form>

    </section>
    <div class="line3"></div>
    <div class="line4"></div>
    <section class="form-container1">
        <div class="box-container">
            <?php
                $select_products=mysqli_query($conn,"SELECT * FROM `products` ORDER BY product_id DESC") or die('query failed');
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_products= mysqli_fetch_assoc($select_products)){

                    //}

                //}

            ?>
            <div class="box">
                <img src="img/<?php echo $fetch_products['image']; 
                ?>
                ">

                <h4>Price: <?php echo $fetch_products['price']; ?> Taka</h4>
                <h4><?php echo $fetch_products['name']; ?></h4>
                <details>
                    Quantity: <?php echo $fetch_products['product_quantity']; ?><br>
                    Category: <?php echo $fetch_products['category']; ?><br>
                    Description: <?php echo $fetch_products['detail']; ?><br>
                </details>
                <a href="admin_product.php?edit=<?php echo $fetch_products['product_id']; ?>"class="edit">edit</a>
                <a href="admin_product.php?delete=<?php echo $fetch_products['product_id']; ?>"class="delete" onclick="
                    return confirm('want to delete this product');">delete</a>


            </div>
            <?php
                    }
                }else{
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
            if(isset($_GET['edit'])) {
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE product_id='$edit_id'")or die('query failed');
                if(mysqli_num_rows($edit_query)>0){
                    while($fetch_edit = mysqli_fetch_assoc($edit_query)){

                    
                //}
           // }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <img src="img/<?php echo $fetch_edit['image'];?>">
            
            <input type="hidden" name="update_id" value="<?php echo $fetch_edit['product_id'];?>">
            <input type="text" name="update_name" value="<?php echo $fetch_edit['name'];?>">
            
            <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price'];?>">
            <input type="number" name="update_quantity" min="0"value="<?php echo $fetch_edit['product_quantity'];?>">
            <select  name="update_category" required>
            <option value="" disabled selected hidden><?php echo $fetch_edit['category'];?></option>
                        <option value="Fruits And Vegetables">Fruits & Vegetables</option>
                        <option value="Dairy And Eggs">Dairy & Eggs</option>
                        <option value="Meat And Seafood">Meat & Seafood</option>
                        <option value="Bakery And Bread">Bakery & Bread</option>
                        <option value="Frozen Foods And Drinks">Frozen Foods & Drinks</option>
                        <option value="Snacks And Sweets">Snacks & Sweets</option>
                        <option value="Others">Others</option>
                    </select>
            <textarea name="update_detail"><?php echo $fetch_edit['detail'];?></textarea>
            
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png, image/webp"
            value="img/<?php echo $fetch_edit['image'];?>">

            <input type="submit" name="updte_product" value="update" class="btn2" onclick="return confirm('Want to update this product?')">
            <input type="reset" value="Cancel" class="btn2"  id="go-back" onclick="window.history.back();">
        </form>
        <?php 
                    }
                }
                echo "<script>document.querySelector('.update-container').style.display='block'</script>";
            }
        ?> 

    </section>
    <script type="text/javascript" src="scriptmain2.js"></script>
</body>
</html>