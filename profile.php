<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
include 'config/db_config.php';

$username = '';
if (isset($_GET['user'])) {
    $username = $_GET['user'];
} else {
    header("Location: login.php");
}
$query = "SELECT * FROM post WHERE username = ? ORDER BY created_at DESC";
$result = mysqli_execute_query($conn, $query, [$username]);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT name FROM user WHERE username = ? LIMIT 1";
$result = mysqli_execute_query($conn, $query, [$username]);
$name = mysqli_fetch_column($result);

function getPostId($postId)
{
    echo "edit_post.php?post={$postId}";
}

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
    <title><?php echo $username ?> profile</title>
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
                <div class="cardRow">
                    <i class="bi-person-circle"></i>
                    <span><?php echo $username; ?></span>
                </div>
                <div class="separator"></div>
                <div class="cardBody">
                    <span><?php echo htmlspecialchars($name); ?></span>
                </div>
            </div>
            <?php foreach ($posts as $post) : ?>
                <div class="postCard">
                    <div>
                        <?php echo htmlspecialchars($post['contents']); ?>
                    </div>
                    <div class="separator"></div>
                    <?php if (strcmp($username, $_SESSION['username']) == 0) : ?>
                        <div class="cardRow">
                            <span class="dateTime">
                                <?php echo date_format(
                                    date_create($post['created_at']),
                                    "d-m-Y H:i"
                                ); ?>
                            </span>
                            <a href="<?php getPostId($post['post_id']); ?>" class="rightAlignEl iconLink">
                                <i class="bi-pencil-square"></i>
                            </a>
                        </div>
                    <?php endif;  ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>