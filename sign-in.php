
<?php include 'header.php';?>

<div class="sign-in">
  <h2 class="title"><?php echo 'Sign in'. $test;?></h2>
  <form action="sign-in.php" method="POST" class="sign-in__form form">
    <label class="login label">
      <span class="login__title">Login</span>
      <input class="login__input input" type="text" name="login" id="login">
    </label>
    <label class="password label">
      <span class="password__title">Password</span>
      <input type="password" class="password__input input" name="password" id="password">
    </label>
    <input type="submit" class="sign-in__btn btn" name="sign-in-btn" value="Sign in">
  </form>
</div>

<?php include 'footer.php';?>