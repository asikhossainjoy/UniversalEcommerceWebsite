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
                <img src="img/slide.png">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium<br>Vegetable</h1>
                    <p>Green Bag Vegetables are usually classified on the basis of the part of the plant that<br>
                       is used for food.The root vegetables include beets, carrots, radishes, sweet potatoes,<br> and turnips.   
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/slide3.png">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium<br>Fruit</h1>
                    
                    <p>Green Bag Organic Fruit is 100% certified organic: peaches, apricots, nectarines,<br>
                     cherries, plums, pears and apples. You can enjoy safe, delicious organic fruit <br>
                     year-round with our jams and fruit in a jar   
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/slide4.png">
                <div class="slider-caption2">
                    <span>Test The Quality</span>
                    <h1>Organic Premium<br>Meat</h1>
                    <p>Eating Grass-Fed Meat Promotes Cardiovascular Health<br>
                        Organic Green Bag Meat is considered much heart-healthier than grain-fed beef, which likely<br>
                        contributed to its higher content of good fats yet lower levels of saturated fats.   
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/slide5.png">
                <div class="slider-caption2">
                    <span>Test The Quality</span>
                    <h1>Organic Premium<br>Fruit Juice</h1>
                    <p>Green Bag Fruit juice entices with its rich, vibrant color and distinctive flavor.<br>
                        Packed with antioxidants and dietary fiber, it's not only a treat for your
                        <br>taste buds but also a boon for your health.   
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="img/slide6.png">
                <div class="slider-caption">
                    <span>Test The Quality</span>
                    <h1>Organic Premium<br>Egg</h1>
                        
                    <p>Organic Green Bag Egg is the production of eggs through organic way.<br>
                        In this process, the hens are fed fully organic feed. No chemical-mixed into it.   
                    </p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            
        </div>
        <div class="controls">
                <i class="bi bi-chevron-left prev"></i>
                <i class="bi bi-chevron-right next"></i>
            </div>
    </div>


    
    <div class="line2"></div>
    <div class="container">
        <h2 >Category</h2>

        <div class="grid">
            <div class="grid-wrapper">
                <div class="grid-image">
                    <a href="category.php?view1=<?php echo "Fruits And Vegetables" ?>">
                        <img src="img/ca1.png" alt="Grid-01" /></a>
                    
                </div>
                <div class="grid-title">
                    <h4>Fruits & Vegetables</h4>
                </div>
            </div>
        </div>

        <div class="grid">
            <div class="grid-wrapper">
                <div class="grid-image">
                <a href="category.php?view1=<?php echo "Dairy And Eggs" ?>">
                    <img src="img/ca2.png" alt="Grid-02" /></a>
                </div>
                <div class="grid-title">
                    <h4>Dairy & Eggs</h4>
                    
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-wrapper">
                <div class="grid-image">
                <a href="category.php?view1=<?php echo "Meat And Seafood" ?>">
                    <img src="img/ca3.png" alt="Grid-03" /></a>
                </div>
                <div class="grid-title">
                    <h4>Meat & Seafood</h4>
                    
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-wrapper">
                <div class="grid-image">
                <a href="category.php?view1=<?php echo "Bakery And Bread" ?>">
                    <img src="img/ca8.png" alt="Grid-04"/></a>
                </div>
                <div class="grid-title">
                    <h4>Bakery & Bread</h4>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="grid-wrapper">
                <div class="grid-image">
                <a href="category.php?view1=<?php echo "Frozen Foods And Drinks" ?>">
                    <img src="img/ca5.png" alt="Grid-05" /></a>
                </div>
                <div class="grid-title">
                    <h4>Frozen Foods & Drinks</h4>
                </div>
            </div>
        </div>
        
           
            <div class="grid">
                <div class="grid-wrapper">
                    <div class="grid-image">
                    <a href="category.php?view1=<?php echo "Snacks And Sweets" ?>">
                        <img src="img/ca7.png" alt="Grid-06" /></a>
                    </div>
                    <div class="grid-title">
                        <h4>Snacks & Sweets</h4>
                    </div>
                </div>

        
    </div>
    
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
    <div class="services">
        <div class="rows">
            <div class="box">
                <img src="img/0.png">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>Fast, Free Shipping Anywhere, Anytime.</p>
    
                </div>
            </div>
            <div class="box">
                <img src="img/1.png">
                <div>
                    <h1>Money Back & Garantee</h1>
                    <p>Money-back guarantee for your satisfaction.</p>
                </div>
            </div>
            <div class="box">
                <img src="img/3.png">
                <div>
                    <h1>Online Support 24/7</h1>
                    <p>Resolve queries 24/7, anytime, anywhere.</p>
    
                </div>
            </div>
        </div>
    </div>
    <div class="line2"></div>
    <div class="story">
        <div class="rows">
            <div class="box">
                <span>our story</span>
                <h1>Production of organic vegetables and fruits since 1990</h1>
                <p>Since 1990, the soil whispered secrets of sustainable growth, nurturing organic<br> vegetables and fruits into a thriving symphony of flavors, where each harvest tells
                    <br>a tale of nature's timeless commitment to wholesome nourishment.</p>
                <a href="shop.php" class="btn2">shop now</a>
            </div>
            <div class="box1">
                <img src="img/81.png">
            </div>
        </div>
    </div>
    <div class="line3"></div>



    

    


    

    
    


    
    <?php include 'footer.php';?>
    <!--------------slick slider link---------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type= "text/javascript" src="main.js"></script>

    
</body>
</html>