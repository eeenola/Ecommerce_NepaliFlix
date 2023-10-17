<?php
include 'C:\xampp\htdocs\NepaliFlix\include\connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: loginform.php');
    exit();
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Use prepared statement to prevent SQL injection
    $delete_query = mysqli_prepare($conn, "DELETE FROM `message` WHERE id = ?");
    mysqli_stmt_bind_param($delete_query, "i", $delete_id);
    
    // Execute the delete query
    if (mysqli_stmt_execute($delete_query)) {
        header('Location: ad_contacts.php');
        exit();
    } else {
        echo "Error deleting message: " . mysqli_error($conn);
    }

    mysqli_stmt_close($delete_query);
}

$select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Your existing head content... -->
   <!-- custom css file link -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   
<?php include 'C:\xampp\htdocs\NepaliFlix\include\header.php'; ?>

<section class="messages">
   <h1 class="title"> Messages </h1>
   <div class="box-container">
   <?php
      if (mysqli_num_rows($select_message) > 0) {
         while ($fetch_message = mysqli_fetch_assoc($select_message)) {
   ?>
   <div class="box">
      <p> user id : <span><?php echo $fetch_message['userid']; ?></span> </p>
      <a href="?delete=<?php echo $fetch_message['id']; ?>" class="delete-btn" onclick="return confirm('Delete message with ID <?php echo $fetch_message['id']; ?>?')">delete message</a>
   </div>
   <?php
      }
   } else {
      echo '<p class="empty">you have no messages!</p>';
   }
   ?>
   </div>
</section>

<!-- custom admin js file link -->
<script src="js/admin_script.js"></script>
</body>
</html>
