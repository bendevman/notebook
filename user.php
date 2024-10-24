
<?php include 'header.php';?>
<?php 
  if (!isset($_SESSION['id'])) {
   header('Location: index.php'); 
  }
?>
<h2 class="title"><?php echo 'User';?></h2>
<h2 class="title"><?php echo $_SESSION['id'];?></h2>

<?php include 'footer.php';?>
