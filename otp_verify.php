<?php
 session_start();
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\Exception.php';
require 'PHPMailer\PHPMailer.php';
require 'PHPMailer\SMTP.php';

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $otp = rand(1000, 9999);

    $mail->isSMTP();
    $mail->Host         = 'smtp.gmail.com';
    $mail->SMTPAuth     = true;
    $mail->Username     = 'heetkadivar212@gmail.com';
    $mail->Password     = 'nfrspvgzzoxoufjr';//app key
    $mail->SMTPSecure   = 'ssl';
    $mail->Port         = 465;

    $mail->setFrom('heetkadivar212@gmail.com', 'Heet Kadivar');
    $mail->addAddress($_SESSION['user_email']);

    $mail->isHTML(true);
    $mail->Subject = 'OTP Verification';
    $mail->Body    = 'Your OTP for registration is: ' . $otp;

    if ($mail->send()) {
       
        $_SESSION['session_otp'] = $otp;
   
        $_SESSION['success_message'] = '<div class="alert alert-success" role="alert"><b>OTP sent successfully on the: '. $_SESSION['user_email'].'</b></div>';

        header("Location: otp_logic.php");
        exit();
    } else {
        echo "Error sending OTP. Please try again later.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Email Verification</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error_message'].'</div>';
                            unset($_SESSION['error_message']);
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user_email']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Send OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>