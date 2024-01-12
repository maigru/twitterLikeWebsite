<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'config/db_config.php';

$postError = '';

if (isset($_POST['postSubmit']) && !empty($_POST['postText'])) {
    $query = "INSERT INTO post (contents, username) 
    VALUES (?, ?)";
    $result = mysqli_execute_query($conn, $query, [$_POST['postText'], $_SESSION['username']]);
    if ($result === FALSE) {
        $postError = "Failed to post";
    }
}

$query = 'SELECT * FROM post ORDER BY created_at DESC';
$result = mysqli_query($conn, $query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

$profileLink = '';
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $profileLink = "profile.php?user={$_SESSION['username']}";
} else {
    $profileLink = "login.php";
}
?>



<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <title>Main</title>
</head>

<body>
    <div class="mainWrapper">
        <nav class="sidebar">
            <a href="<?php echo $profileLink; ?>"><i class="bi-person-fill"></i></a>
            <a href="index.php"><i class="bi-house-door-fill"></i></a>
            <a href="logout.php"><i class="bi-door-closed-fill"></i></a>
        </nav>
        <div class="postWrapper">
            <?php if (isset($_SESSION['username'])) : ?>
                <div class="postCard">
                    <form class="cardBody">
                        <textarea id="postText" name="postText" placeholder="What's happening?" maxlength="700" class="txtar" required></textarea>
                        <span class="errorText"><?php echo $postError; ?></span>
                        <div class="cardRow">
                            <button class="rightAlignEl postSubmit" type="submit" name="postSubmit" formaction="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" formmethod="post">
                                <i class="bi-pencil-square"></i>
                            </button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            <?php foreach ($posts as $post) : ?>
                <div class="postCard">
                    <div class="cardRow">
                        <i class="bi-person-circle"></i>
                        <a href="profile.php?user=<?php echo htmlspecialchars($post['username']); ?>" class="textLink">
                            <?php echo htmlspecialchars($post['username']); ?>
                        </a>
                        <span class="rightAlignEl dateTime">
                            <?php echo date_format(
                                date_create($post['created_at']),
                                "d-m-Y H:i"
                            ); ?>
                        </span>
                    </div>
                    <div class="separator"></div>
                    <div>
                        <?php echo htmlspecialchars($post['contents']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="script/resize_textarea.js"></script>
</body>

</html>