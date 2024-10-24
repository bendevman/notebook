
<?php include 'header.php';?>
<?php 
  if(isset($_SESSION['id'])) {
    header('Location: index.php');
  }

  $login = '';
  $password = '';
  $id = '';
  $errors = [];

  $regEmail = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
  $regPhone = '/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/';
  $regPassword = '/^.{8,}$/';

  $chekForUserSql = '';
  $userResult = '';
  $userExist = '';
  
  if (isset($_POST['sign-in-btn'])) {
    if (!empty($_POST['login'])) {
      if (preg_match($regEmail, $_POST['login']) || preg_match($regPhone, $_POST['login'])) {
        $login = htmlspecialchars($_POST['login']);

        $chekForUserSql = "select * from users where login = '$login'";
        $userResult = mysqli_query($db, $chekForUserSql);
        $userExist = mysqli_fetch_assoc($userResult);

        if (!$userExist) {
          array_push($errors,'No user with this login exist, please register');
        }
      } else {
        array_push($errors,'Login should be email or phone number');
      }
    } else {
      array_push($errors,'Login is required');
    }
    if (!empty($_POST['password'])) {
      if (preg_match($regPassword, $_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
      } else {
        array_push($errors,'Password should be at least 8 characters');
      }
    } else {
      array_push($errors,'Password is required');
    }
    if (!$errors) {
      if (password_verify($password, $userExist['password'])) {
        $_SESSION['id'] = $userExist['id'];
        header('Location: index.php');
      }
    }
  }
?>
<div class="sign-in">
  <h2 class="title"><?php echo 'Sign in';?></h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="sign-in__form form">
    <label class="login label">
      <span class="login__title">Login* <i>(email or phone number)</i></span>
      <input class="login__input input" type="text" name="login" id="login">
    </label>
    <label class="password label">
      <span class="password__title">Password* <i>(at least 8 characters)</i></span>
      <input type="password" class="password__input input" name="password" id="password">
    </label>
    <input type="submit" class="sign-in__btn btn" name="sign-in-btn" value="Sign in">
    <?php foreach ($errors as $error):?>
      <span class="error-msg"><?php echo $error?></span>
    <?php endforeach;?>
  </form>
</div>

<?php include 'footer.php';?>