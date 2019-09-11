<?php
const DB_SERVER = "cisdbss.pcc.edu";
const DB_DATABASE = "234a_PHPeeps";
const DB_USER = "234a_PHPeeps";
const DB_PASSWORD = "IfIhad100wishes#";

use PHPMailer\PHPMailer\PHPMailer;



?>

<?php

if ( isset( $_POST[ 'forgot-password' ] ) ) {
    require 'PantryDatabase.php';
    $email = $_POST['mail'];
    if (empty($email)) {
        header("Location: forgot_password_content.php?error=emptyfields");
        exit();

    } else {


        $db = new PantryDatabase();
        $email_check = $db->lookupUser($email);
        if (!$email_check) {

            header("Location: forgot_password_content.php?error=UserDoesNotExist");
            echo "Row update failed.\n";
            die(print_r(sqlsrv_errors(), true));
        } else {
            echo $email;
            $string = 'qwertyuiopasdfghjklzxcvbnm1234567890';
            $shuffle = str_shuffle($string);
            $userToken = substr($shuffle, 0, 15);
            $db = new PantryDatabase();

            $db->recoveryToken($userToken, $email);


          require_once "../vendor/autoload.php";

            $mail = new PHPMailer;


//Enable SMTP debugging.

//Set PHPMailer to use SMTP.
            $mail->isSMTP();
//Set SMTP host name
            $mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
//Provide username and password
            $mail->Username = "pcc.pantry.email@gmail.com";
            $mail->Password = "Orcaworm1";
//If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = 'tls';
//$mail->SMTPSecure = "tls";
//Set TCP port to connect to
            $mail->Port = 587;

            $mail->From = "pcc.pantry.email@gmail.com";
            $mail->FromName = "pcc pantry";

            try {
                $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
                );
            } catch (\PHPMailer\PHPMailer\Exception $e) {
            }

            $mail->addAddress($email, "recover account");

            $mail->isHTML(true);

            $mail->Subject = "Recovery link";
            $mail->Body = "<i>Please click the link to reset your password</i>
                            <a href='http://localhost/projects/testme1/includes/reset_confirmed.php?email=$email&token=$userToken'>CLICK ME</a>";
            $mail->AltBody = "This is the plain text version of the email content";

            try {
                if (!$mail->send()) {

                    header('Location:forgot_password_content.php?mail-send=failed');
                } else {

                    header('Location:forgot_password_content.php?mail-send=successful');
                    exit();


                }
            } catch (\PHPMailer\PHPMailer\Exception $e) {
            }

        }

    }
}
