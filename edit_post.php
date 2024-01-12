<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'config/db_config.php';

$profileLink = '';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $profileLink = "profile.php?user={$_SESSION['username']}";
} else {
    $profileLink = "login.php";
}

$updateErr = '';
if (isset($_POST['postSubmit']) && !empty($_POST['postText'])) {
    $postId = 0;
    $updatedText = '';
    if (!empty($_POST['postId'])) {
        $postId = $_POST['postId'];
    } else {
        $updateErr = "How did you get here!?";
    }
    if (!empty($_POST['postText'])) {
        $updatedText = $_POST['postText'];
    } else {
        $updateErr = "Post can't be empty";
    }
    if ($updateErr == '') {
        $query = "UPDATE post SET contents=? WHERE post_id=?";
        $result = mysqli_execute_query($conn, $query, [$updatedText, $postId]);
        if (mysqli_affected_rows($conn) <= 0) {
            $updateErr = "Failed to update";
        } else {
            header("Location: {$profileLink}");
        }
    }
}

$postId = '';
if (isset($_GET['post'])) {
    $postId = $_GET['post'];
} else {
    header("Location: index.php");
}

$query = "SELECT contents FROM post WHERE post_id=? LIMIT 1";
$result = mysqli_execute_query($conn, $query, [$postId]);
$postText = mysqli_fetch_column($result);

?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <title>Edit post</title>
</head>

<body>
    <div class="mainWrapper">
        <nav class="sidebar">
            <a href="<?php echo $profileLink; ?>"><i class="bi-person-fill"></i></a>
            <a href="index.php"><i class="bi-house-door-fill"></i></a>
            <a href="logout.php"><i class="bi-door-closed-fill"></i></a>
        </nav>
        <div class="postWrapper">
            <div class="postCard">
                <form class="cardBody">
                    <textarea class="txtar" name="postText" id="postText" maxlength="700" require><?php echo htmlspecialchars($postText); ?></textarea>
                    <input type="hidden" name="postId" value="<?php echo $postId; ?>">
                    <div class=" cardRow">
                        <button class="rightAlignEl postSubmit" type="submit" name="postSubmit" formaction="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" formmethod="post">
                            <i class="bi-pencil-square"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="script/resize_textarea.js"></script>
</body>