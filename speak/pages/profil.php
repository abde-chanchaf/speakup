<?php
require_once '../../config.php';

if (isset($_SESSION['id'])) {
   $id = $_SESSION['id'];
} else {
    $id = isset($_COOKIE['id']);
    if (!$id) {
        header("Location: login.php");
        exit;
    }
}

$user_id = isset($_GET["id"]) ? $_GET["id"] : $id;

$sql = "SELECT name_us, email_us, nickname_us, created_at, img_us FROM user WHERE id_us = $user_id";
$result = $con->query($sql);

if (!$result) {
    echo "Query failed: " . mysqli_error($con);
}

if (mysqli_num_rows($result) > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Profile</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../css/profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> 
  <style>
  .rtn {
    position: absolute;
    top: 190px;
    right: 59vw;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #333;
}
  </style>
</head>
<body>
    <div class="back">
        <button class="rtn" onclick="history.back();">
            <i class="fas fa-arrow-left"></i>
        </button>
        <div class="profil">  
            <?php if ($user['img_us']) { ?>
                <img src="../../images/<?php echo $user['img_us']; ?>" class="imgprf">
            <?php } ?> 

            <h2><?php echo $user['name_us'] ?></h2>
            <h3><?php echo $user['nickname_us'] ?></h3>
            <p class="email">Email: <?php echo $user['email_us'] ?></p>
            <p class="time">Joined: <?php echo date("F j, Y", strtotime($user['created_at'])); ?></p>
        </div>
    </div>
</body>
</html>
