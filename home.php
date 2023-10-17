<?php

include 'C:\xampp\htdocs\NepaliFlix\include\connect.php';

session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:userloginform.php');
}
include 'C:\xampp\htdocs\NepaliFlix\addtocart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'C:\xampp\htdocs\NepaliFlix\include\head.php'; ?>

<section class="home">

   <div class="content">
      <h3>Hand Picked Movie to your door.</h3>
      <p>The book you want is just a click away.</p>
      <a href="about.php" class="white-btn">Discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">Our products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">See More</a>
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <!-- <img src="images/about-img.jpg" alt=""> -->
      </div>

      <div class="content">
         <h3>About Us</h3>
         <p>
            We have one of the highest collection of Nepali Books and Movies to your liking and would like to keep on adding to this category a lot more.
         </p>
         <a href="about.php" class="btn">Read More</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Have Any Questions?</h3>
      <p>If u have any questions or feedback regarding our organization and website please feel free to contact us.</p>
      <a href="contact.php" class="white-btn">Contact us</a>
   </div>

</section>





<?php include 'C:\xampp\htdocs\NepaliFlix\include\footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>