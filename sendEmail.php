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
            $password_enq = password_hash($pw, PASSWORD_DEFAULT);
    $sql = "insert into User(Email,Wachtwoord,Naam,Rol)values('" . $gebruiker['email'] . "','" . $password_enq . "','" . $gebruiker['naam'] . "','" . $gebruiker['rol'] . "');";
    if (mysqli_query($conn, $sql)) {
         $superSql = "select * from User where rol=1";
         $superRow = mysqli_query($conn,$superSql);
         $superResult = mysqli_fetch_assoc($superRow);

        $mail = new PHPMailer('true');

        $mail->isSMTP();
        $mail->Host = 'mail.antagonist.nl';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'yusuf@lesonline.nu';
        $mail->Password = '8xfYXNZ7';

        $mail->setFrom("$superResult[Email]", "$superResult[Naam]");
        //$mail->addAddress("".$group['email'].", ".$group['group']."");
        $mail->addAddress("$gebruikerEmail", "$gebruikerNaam");

        $mail->Subject = "Nieuwe account";
        $mail->isHTML();
        $mail->Body = "
     <h3><strong>Uw nieuwe account</strong></h3>
     Klik <strong><a href='https://yusuf.lesonline.nu/Hotelkamerschoonmaakplanapp/index.php'>hier</a></strong> om in te loggen.
     <p>Uw inloggegevens zijn:</p>
     <p>E-mail : '$gebruikerEmail'</p> 
     <p>Wachtwoord : '$pw'</p>
     <p>Met vriendelijk groet,&nbsp;</p>
     <p>Hotelkamerschoonmaakapp</p>
    
    
    
    ";


        $mail->send();
        session_start();

        header("location:accounts.php?newAccount");
        }

    }
    }
}
?>

