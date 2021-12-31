<?php

    require 'Mailer/PHPMailer.php';
    require 'Mailer/SMTP.php';
    require 'Mailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class dbhelper{

        //generate random password
        public function getRandomPassword(){
            //genarating a new random password
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
            $digit = "0123456789";
            //7 alphabet 
            for ($i = 0; $i < 7; $i++) {
                $index = rand(0, strlen($alphabet)-1);
                $pass[$i] = $alphabet[$index];
            }
            //1 digit
            $index = rand(0, strlen($digit)-1);
            $pass[$i++] = $digit[$index];

            //Converting array to string
            $newpass = "";
            foreach($pass as $ch){
                $newpass .= $ch;
            }

            return $newpass;
        }

        function sendNewPassword($to,$newPass){
            $mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "StartTLS";
			$mail->Port = "587";
			$mail->Username = "dataque.academy@gmail.com";
			$mail->Password = "data01001";
			$mail->Subject = "NSUVMS password recovery";
			$mail->setFrom('dataque.academy@gmail.com');
			$mail->isHTML(true);
			$mail->Body = "<h1>Dear user,</h1><p>You have requested to change the password of your NSUVMS account! "
							. "We have assigned a new password for your account.</p>"
							. "<p>The new password for your account is: <b>". $newPass ."</b></p>";

			$mail->addAddress($to);
			if($mail->send()){
                $mail->smtpClose();
				return true;
			}else{
                $mail->smtpClose();
				return false;
			}
        }
    }
?>