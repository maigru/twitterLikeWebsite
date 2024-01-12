<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'config/db_config.php';

$username = $password = '';
$nameErr = $passErr = '';

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
        $query = "SELECT password FROM user WHERE username = ? LIMIT 1";
        $result = mysqli_execute_query($conn, $query, [$username]);
        if ($result->num_rows == 1) {
            $password = mysqli_fetch_column($result);
        } else {
            $nameErr = "No user with this '{$username}' username found";
        }
    }
    if (
        !empty($_POST['password']) &&
        strcmp($_POST['password'], $password) == 0
    ) {
        if ($nameErr == '') {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }
    } else {
        $passErr = "Wrong password";
    }
}

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/styles.css" />
    <title>Login page</title>
    <script src="script/validate_form.js"></script>
</head>

<body class="signUpBody">
    <div class="formWrapper">
        <form class="formFlex" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate onsubmit="return validateLogin()">
            <div class="formHeadline">Welcome back!</div>
            <input type="text" class="formItem" placeholder="Username" id="username" name="username" maxlength="40" pattern="[\w]*" required />
            <span class="errorText" id="nameErr"><?php echo $nameErr; ?></span>
            <input type="password" class="formItem" placeholder="Password" id="password" name="password" minlength="8" maxlength="255" pattern="[A-Za-z0-9]+?" required />
            <span class="errorText" id="passErr"><?php echo $passErr ?></span>
            <input type="submit" class="formItem formButton" value="Log in" id="submit" name="submit" />
            <div>New user? <a href="signup.php" class="textLink">Sign up</a></div>
        </form>
    </div>
</body>

</html>