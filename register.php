
<?php include 'header.php';?>
<?php
  if(isset($_SESSION['id'])) {
    header('Location: index.php');
  }
  
  $login = '';
  $password = '';
  $passwordHash = '';
  $errors = [];

  $regEmail = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
  $regPhone = '/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/';
  $regPassword = '/^.{8,}$/';

  if (isset($_POST['register-btn'])) {
    if (!empty($_POST['login'])) {
      if (preg_match($regEmail, $_POST['login']) || preg_match($regPhone, $_POST['login'])) {
        $login = htmlspecialchars($_POST['login']);

        $chekForUserSql = "select * from users where login = '$login'";
        $userResult = mysqli_query($db, $chekForUserSql);
        $userExist = mysqli_num_rows($userResult);
        if (mysqli_num_rows($userResult)) {
          array_push($errors,'User with this login already exist, please sing in');
        }
      } else {
        array_push($errors,'Login should be email or phone number');
      }
    } else {
      array_push($errors,'Login is required');
    }
    if (!empty($_POST['password']) && !empty($_POST['repeat-password'])) {
      if ($_POST['password'] === $_POST['repeat-password']) {
        if (preg_match($regPassword, $_POST['password'])) {
          $password = htmlspecialchars($_POST['password']);
          $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        } else {
          array_push($errors,'Password should be at least 8 characters');
        }
      } else {
        array_push($errors,'Password and repeat password doesnt match');
      }
    }else {
      array_push($errors,'Password and repeat password are required');
    }
    
    $addUser = "insert into users (login, password) values ('$login', '$passwordHash')";
    if (!$errors) {
      if (mysqli_query($db, $addUser)) {
        header('Location: sign-in.php');
      } else {
        echo 'Error: '. mysqli_error($db);
      }
    }
  }
?>
<div class="register">
  <h2 class="title"><?php echo 'Register';?></h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="register__form form">
    <label class="login label">
      <span class="login__title">Login* <i>(email or phone number)</i></span>
      <input class="login__input input" type="text" name="login" id="login">
    </label>
    <label class="password label">
      <span class="password__title">Password* <i>(at least 8 characters)</i></span>
      <input type="password" class="password__input input" name="password" id="password">
    </label>
    <label class="password label">
      <span class="password__title">Repeat password* </span>
      <input type="password" class="password__input input" name="repeat-password" id="repeat-password">
    </label>
    <input class="register__btn btn" name="register-btn" type="submit" value="Register">
    <?php foreach ($errors as $error):?>
      <span class="error-msg"><?php echo $error?></span>
    <?php endforeach;?>
  </form>
</div>

<?php include 'footer.php';?>