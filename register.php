
<?php include 'header.php';?>

<div class="register">
  <h2 class="title"><?php echo 'Register';?></h2>
  <form action="register.php" class="register__form form">
  <label class="login label">
      <span class="login__title">Login</span>
      <input class="login__input input" type="text" name="login" id="login">
    </label>
    <label class="password label">
      <span class="password__title">Password</span>
      <input type="password" class="password__input input" name="password" id="password">
    </label>
    <label class="password label">
      <span class="password__title">Repeat password</span>
      <input type="password" class="password__input input" name="repeat-password" id="repeat-password">
    </label>
    <input class="register__btn btn" name="register-btn" type="submit" value="Register">
  </form>
</div>

<?php include 'footer.php';?>