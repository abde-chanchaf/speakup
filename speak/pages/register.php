<?php
require_once '../../config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>register</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>


<div class="container mt-5 my-5">-
<div class="row">
    <div class="col-4"></div>
    <div class="lo col-4 border border-dark mt-5 rounded">
    <center><h1 class="mb-3 mt-2">Register</h1></center>
    <form  method="post" enctype='multipart/form-data'>
    <div class="dd">
    <label class="text-start  mt-5"><h6>Full name :</h6></label>
    <input class="mb-2 form-control" required type="text" name="nom" placeholder="your name...">
    
    <label class="text-start mt-3"><h6>Nickname :</h6></label>
        <input class="mb-2 form-control" required type="text" name="nickname" placeholder="Your nickname...">

    <label class="text-start "><h6>Email :</h6></label>
    <input class="mb-2 form-control"  required type="email" name="email" placeholder="email...">
    
    <label class="text-start "><h6>Password :</h6></label>
    <input class="mb-2 form-control"  required type="password" name="password" placeholder="password...">
    <label class="text-start "><h6>Picture :</h6></label>
    <input type="file" class="form-control" accept="image/*" name="image" id="image" required>

    </div>
    <div class="hh">
        <input class="btn btn-outline-light mt-3 mb-3"  type="submit" value="Ajout">
    <a class="btn2 mt-3 btn btn-outline-light mb-3" href="login.php">login</a>
    </div>
      
</form></div>
    <div class="col-4"></div>
</div>
</div>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// ---------------------start 6 chivres-------------------
function generateCode() {
    $letter1 = '';
    $letter2 = '';
    for ($i = 0; $i < 1; $i++) {
        $letter1 .= chr(rand(65, 90));
        $letter2 .= chr(rand(65, 90));
    }

    $number1 = rand(10, 99);
    $number2 = rand(10, 99);

    return $letter1 . $number1 . $letter2 . $number2;
}
// ---------------------------end 6 chivres-------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom1 = $_POST['nom'];
    $nickname1 = $_POST['nickname'];
    $email1 = $_POST['email'];
    $password1 = $_POST['password'];
    $passwordH = $password1;
    $verification_code = generateCode();

    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $floder = "images/" . $image;

    if (move_uploaded_file($tempname, $image)) {
        // check dejjjja exists
        $query = "SELECT * FROM user WHERE email_us='$email1'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<center><span class="badge text-bg-danger"><h6>Email already exists</h6></span></center>';
        } else {
            // Insert in db
            $sql = "INSERT INTO user (email_us, name_us, nickname_us, pass_us, verification_code, img_us) 
                    VALUES ('$email1', '$nom1', '$nickname1', '$passwordH', '$verification_code', '$image')";
            if (mysqli_query($con, $sql)) {
                sendEmail($email1, $verification_code); // Send email verifc
                header("Location: verify.php?email=$email1"); // 
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    } else {
        echo "<center><span class='badge text-bg-danger'><h6>Image upload failed</h6></span></center>";
    }
}

// Function to send verification email
function sendEmail($email, $code) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chkouritarik03@gmail.com'; // Replace with your email
        $mail->Password = 'dmwvqrhcmwspzrnc'; // Replace with your email password (App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('chkouritarik03@gmail.com', 'SpeakUp');
        $mail->addAddress($email, $email); // Email is passed as recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = "Your verification code is: <strong>$code</strong>";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

</body>
</html>
