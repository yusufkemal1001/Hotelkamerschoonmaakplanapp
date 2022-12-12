<?php
include 'dbcon.php';
require __DIR__ . "/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;


function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

//for ($i=0; $i< as $email){
//    $sql = "insert into teams(naam,email,speurtocht_id,uuid)values('$_POST[group]','$email','$_GET[id]','$uuid');";
//}


foreach ($_POST['gebruiker'] as $gebruiker) {

    $select = mysqli_query($conn, "SELECT Email FROM `User` WHERE `Email` = '".$gebruiker['email']."'") or exit(mysqli_error($conn));
    if(mysqli_num_rows($select)) {
        header("location:accounts.php?existingEmail");
        die();

    }else{


    $pw = randomPassword();
        $gebruikerNaam = $gebruiker['naam'];
        $gebruikerEmail = $gebruiker['email'];
        if (!filter_var($gebruikerEmail, FILTER_VALIDATE_EMAIL)) {
            header("location:accounts.php?wrongEmail");
            die();

        }else{
    $sql = "insert into User(Email,Wachtwoord,Naam,Rol)values('" . $gebruiker['email'] . "','" . $pw . "','" . $gebruiker['naam'] . "','" . $gebruiker['rol'] . "');";
    if (mysqli_query($conn, $sql)) {

        


        $mail = new PHPMailer('true');

        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '5baa4c8a8ff55f';
        $mail->Password = 'c91b452b96c05a';

        $mail->setFrom("yusufkemal02@gmail.com", "Yusuf");
        //$mail->addAddress("".$group['email'].", ".$group['group']."");
        $mail->addAddress("$gebruikerEmail", "$gebruikerNaam");

        $mail->Subject = "Nieuwe account";
        $mail->isHTML();
        $mail->Body = "
     <h3><strong>Uw nieuwe account</strong></h3>
     <p>&nbsp;</p>
     
     Klik <strong><a href='http://127.0.0.1:8080/'>hier</a></strong> om in te loggen.
     <p>Uw inloggegevens zijn:</p><br>
     <p>E-mail : '$gebruikerEmail'</p> 
     <p>Wachtwoord : '$pw'</p>
     <p>Met vriendelijk groet,&nbsp;</p>
     <p>Hotelkamerschoonmaakapp</p>
    
    
    
    ";
        /*$checkMail = new VerifyEmail();

        if($checkMail->check($groupEmail)){
            echo 'Email &lt;'.$groupEmail.'&gt; is exist!';
            $mail->send();
        }elseif(verifyEmail::validate($groupEmail)){
            echo 'Email &lt;'.$groupEmail.'&gt; is valid, but not exist!';
        }else{
            echo 'Email &lt;'.$groupEmail.'&gt; is not valid and not exist!';
        }*/

        $mail->send();
        session_start();

        header("location:accounts.php?newAccount");
        }

    }
    }
}
?>

