<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<?php include "config/db_config.php";

$username = $name = $password = '';
$usernameErr = $passErr = $nameErr = '';
$signupErr = '';

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
  if (!empty($_POST['username'])) {
    $username = $_POST['username'];
    $result = $conn->execute_query("SELECT username FROM user WHERE username = ?", [$username]);
    if ($result->num_rows > 0) {
      $usernameErr = "This username already exists";
    }
  }
  if (!empty($_POST['name'])) {
    $name = $_POST['name'];
  } else {
    $nameErr = "Enter your name";
  }
  if (!empty($_POST['password'])) {
    $password = $_POST['password'];
  } else {
    $passErr = "Enter your password";
  }
  if (
    $usernameErr == '' &&
    $nameErr == '' &&
    $passErr == ''
  ) {
    $query = "INSERT INTO user (username, name, password) 
    VALUES (?, ?, ?)";
    if ($conn->execute_query($query, [$username, $name, $password]) != TRUE) {
      $signupErr = "Failed to register your account";
    } else {
      $_SESSION['username'] = $username;
      header("Location: index.php");
    }
  }
}

?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles/styles.css" />
  <title>Sign up page</title>
  <script src="script/validate_form.js"></script>
</head>

<body class="signUpBody">
  <div class="formWrapper">
    <form class="formFlex" id="signUpForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate onsubmit="return validateSignup()">
      <div class="formHeadline">Welcome!</div>
      <input type="text" name="name" id="name" class="formItem" placeholder="Name" maxlength="100" required />
      <span id="nameErr"><?php echo $nameErr; ?></span>
      <input type="text" name="username" id="username" class="formItem" placeholder="Username" maxlength="40" pattern="[\w]*" required />
      <span id="usernameErr"><?php echo $usernameErr; ?></span>
      <input type="password" name="password" id="password" class="formItem" placeholder="Password" minlength="8" maxlength="255" pattern="[A-Z]+[a-z]+[0-9]+" required />
      <span id="passErr"><?php echo $passErr; ?></span>
      <input type="submit" name="submit" class="formItem formButton" value="Sign up" />
      <div>Already have an account? <a class="textLink" href="login.php">Sign in</a></div>
    </form>
  </div>
</body>

</html>