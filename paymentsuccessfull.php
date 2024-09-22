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
    
    <!--------------home slider---------------------->
    <div class="container-fluid">
        
            <div class="slider-item">
                <img src="img/ps.png">
                <div class="slider-caption">
                
                    <h1>Thank You For Using Online Payment</h1><p></p>
                    <a href="index.php?" class="btn">Explore More</a>

                </div>
            </div>
            
            
            
            
        </div>
        
    </div>

    
    


    <!--------------slick slider link---------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script type= "text/javascript" src="main.js"></script>

    
</body>
</html>