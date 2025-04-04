<?php
require_once '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $code = $_POST['code'];

    $sql = "SELECT * FROM user WHERE email_us='$email' AND verification_code='$code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
      
        $sql = "UPDATE user SET verified=1 WHERE email_us='$email'";
        if (mysqli_query($con, $sql)) {
            $idus= $row['id_us'];
            header("location:profil.php?id=$idus");
        } else {
            echo '<center><span class="badge text-bg-danger"><h6>Failed to verify email!</h6></span></center>';
        }
    } else {
        echo '<center><span class="badge text-bg-danger"><h6>Invalid verification code!</h6></span></center>';
    }
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>verify email</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
    <form method="post">
        <label>Enter Verification Code:</label>
        <input type="text" name="code" required>
        <input type="hidden" name="email" value="<?= $_GET['email']; ?>">
        <input type="submit" value="Verify">
    </form>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

