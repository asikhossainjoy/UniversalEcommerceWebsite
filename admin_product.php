<?php

include 'connection.php';
session_start();
$admin_id = $_SESSION['admin_name'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
}

// Product Manager Class
class ProductManager {
    protected $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }
}

// Class for Adding Products - S -> Single Responsibility Principle
class ProductAdder extends ProductManager {
    public function addProduct($data, $image) {
        // Logic for adding a product to the database
        $product_name = mysqli_real_escape_string($this->conn, $data['name']);
        $product_price = mysqli_real_escape_string($this->conn, $data['price']);
        $product_quantity = mysqli_real_escape_string($this->conn, $data['quantity']);
        $product_category = mysqli_real_escape_string($this->conn, $data['category']);
        $product_detail = mysqli_real_escape_string($this->conn, $data['detail']);
        $image_folder = 'img/' . $image['name'];

        $insert_product = mysqli_query($this->conn, "INSERT INTO `products` (`name`,`price`,`detail`,`product_quantity`,`category`, `image`)
            VALUES('$product_name','$product_price','$product_detail','$product_quantity','$product_category','{$image['name']}')");

        if ($insert_product) {
            move_uploaded_file($image['tmp_name'], $image_folder);
            return 'Product added successfully';
        }
        return 'Query failed';
    }
}

// Class for Updating Products - S -> Single Responsibility Principle
class ProductUpdater extends ProductManager {
    public function updateProduct($data, $image = null) {
        // Logic for updating an existing product in the database
        $update_id = $data['update_id'];
        $update_name = mysqli_real_escape_string($this->conn, $data['update_name']);
        $update_price = mysqli_real_escape_string($this->conn, $data['update_price']);
        $update_quantity = mysqli_real_escape_string($this->conn, $data['update_quantity']);
        $update_category = mysqli_real_escape_string($this->conn, $data['update_category']);
        $update_detail = mysqli_real_escape_string($this->conn, $data['update_detail']);
        $update_image_folder = 'img/' . $image['name'];

        $update_query = "UPDATE `products` SET `name`='$update_name', `price`='$update_price', `product_quantity`='$update_quantity', `category`='$update_category', `detail`='$update_detail'";

        if ($image) {
            $update_query .= ", `image`='{$image['name']}'";
            move_uploaded_file($image['tmp_name'], $update_image_folder);
        }

        $update_query .= " WHERE `product_id`='$update_id'";
        mysqli_query($this->conn, $update_query);
        return 'Product updated successfully';
    }
}

// Class for Deleting Products - S -> Single Responsibility Principle
class ProductDeleter extends ProductManager {
    public function deleteProduct($id) {
        // Logic for deleting a product from the database
        $select_delete_image = mysqli_query($this->conn, "SELECT * FROM `products` WHERE product_id = '$id'");
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('img/' . $fetch_delete_image['image']);

        mysqli_query($this->conn, "DELETE FROM `products` WHERE product_id = '$id'");
        return 'Product deleted successfully';
    }
}

// Instantiate classes
$productAdder = new ProductAdder($conn);
$productUpdater = new ProductUpdater($conn);
$productDeleter = new ProductDeleter($conn);

$message = [];

// Handle product addition
if (isset($_POST['add_product']) && isset($_FILES['image'])) {
    $message[] = $productAdder->addProduct($_POST, $_FILES['image']);
}

// Handle product deletion
if (isset($_GET['delete'])) {
    $message[] = $productDeleter->deleteProduct($_GET['delete']);
}

// Handle product update
if (isset($_POST['updte_product'])) {
    $image = isset($_FILES['update_image']) ? $_FILES['update_image'] : null;
    $message[] = $productUpdater->updateProduct($_POST, $image);
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