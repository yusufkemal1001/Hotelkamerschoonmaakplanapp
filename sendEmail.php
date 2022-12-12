<?php
include 'dbcon.php';
require __DIR__ . "/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;


function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

//for ($i=0; $i< as $email){
//    $sql = "insert into teams(naam,email,speurtocht_id,uuid)values('$_POST[group]','$email','$_GET[id]','$uuid');";
//}
foreach ($_POST['groups'] as $group) {


    $uuid = guidv4();
    $sql = "insert into teams(naam,email,speurtocht_id,uuid)values('" . $group['group'] . "','" . $group['email'] . "','" . $_GET['id'] . "','$uuid');";
    if (mysqli_query($conn, $sql)) {


        $groupName = $group['group'];
        $groupEmail = $group['email'];
        if (!filter_var($groupEmail, FILTER_VALIDATE_EMAIL)) {
            echo "excuse me good sir/madam/them/they/attack helicopter, could you please check your email if its correct? i couldn't find an email 'I am good rooster '-Hangman 2022 Top Gun Mav";// invalid emailaddress
            die();
        }
        $mail = new PHPMailer('true');

        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '5baa4c8a8ff55f';
        $mail->Password = 'c91b452b96c05a';

        $mail->setFrom("yusufkemal02@gmail.com", "Yusuf");
        //$mail->addAddress("".$group['email'].", ".$group['group']."");
        $mail->addAddress("$groupEmail", "$groupName");

        $mail->Subject = "Meedoen aan de speurtocht ";
        $mail->isHTML();
        $mail->Body = "
     <h3><strong>Uw uitnodiging voor de Speurtocht!</strong></h3>
     <p>&nbsp;</p>
     
     Klik <strong><a href='http://127.0.0.1:8080/quiz.php?id=$uuid&speurtocht_id=$_GET[id]'>hier</a></strong> om mee te doen aan de speurtocht.
     <p>&nbsp;</p>
     
     <p>Veel plezier en we hopen dat u een goeie tijd heeft!</p>
     <p>&nbsp;</p>
     <p>Scrumgroep 2</p>
    
    
    
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
        $_SESSION['active_speurtocht_id']=$_GET['id'];
        header("location:admin.speurtocht.php?id=".$_GET['id']);


    }
}
?>

