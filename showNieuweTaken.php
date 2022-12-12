<?php


include 'dbcon.php';
require 'login.class.php';




if (isset($_SESSION['active_speurtocht_id'])){
    header('location:admin.speurtocht.php?id='.$_GET['id']);
}
//require 'db.php';

$select = new Select();

if (isset($_SESSION["id"])){
    $user = $select->selectUserById($_SESSION["id"]);
}else{
    header("location: index.php");
}

if(isset($_GET['id'])){

$id = (int)$_GET['id'];

$query_fetch = mysqli_query($conn,"SELECT * FROM speurtochten WHERE id = $id");
$query_fetch1 = mysqli_query($conn,"SELECT * FROM vragen WHERE speurtocht_id = $id");
while($row = mysqli_fetch_array($query_fetch)){ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a5e31d35c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="dist/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body style="background-color: #161215;">
<div class="flex">

    <div class="m-auto w-3/5 p-5 rounded-md max-h-screen " >
        <div class=" rounded-md" style="min-height: 400px;">
            <div class=" flex items-center mb-5  " style="color: #F0F7F4">
                <a href="edit.speurtocht.php?id=<?php echo $row['id']; ?>" class="w-2/5 item-center"><i class="m-2 fa-solid fa-arrow-left"></i>Terug</a>
                <div class="m-auto justify-center text-center text-4xl w-3/5 mr-1/5">Groepen</div>
            </div>
            <script>
                let formCount = 2;
                function addTeamForm(){
                    const form = document.querySelector("#teamForm")
                    const div = document.createElement("div")
                    const formCountClone = formCount
                    div.id = "form-count-" + formCountClone
                    console.log(formCount)
                    div.innerHTML = `


                <div class="w-4/4 rounded-md min-h-60    items-center m-auto p-5 mb-5" style="background-color: #7CB3B6;">
<div class="flex items-center" style="font-size: 12px; justify-content: end;"><a onclick="deleteTeamForm(${formCountClone})"><b>Groep verwijderen</b><i class=" p-2 fa-solid fa-trash"></i></a></div>
                    <div class="max-w-full">
                        <div class="w-5/5 max-h-full">
                            <div class="text-xl ">
                                <div class="vraag-counter  p-2 justify-between items-center">
                                    <input type="hidden" value="">
                                    <div class="flex justify-between items-center">
                                        <div class="w-1/5 m-auto text-center"><b>Groep naam</b></div>
                                        <input type="text" class="bg-white rounded-md w-3/4 m-2 p-2 " value="Groep ${formCount}" name="groups[${formCount}][group]"  required>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="m-auto text-center w-1/5"><b>E-mail</b></div>
                                        <input type="text" class="bg-white rounded-md w-3/4 m-2 p-2" value="" name="groups[${formCount}][email]" required >
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                    `
                    formCount++;
                    form.appendChild(div)

                }
                function deleteTeamForm(formCount1){



                    const div = document.getElementById("form-count-" + formCount1)
                    // const formCountClone = formCount -1
                    // console.log("form-count-"+formCount1)
                    div.parentNode.removeChild(div)

                    console.log(formCount)
                    // ;[...form.childNodes.values()].find(n => n.c)
                    //const div = document.createElement("div")
                    // form.removeChild()
//                    div.innerHTML = `
//             <form action="update.vraag.php" method="get" id="teamForm">
//             <div class="formclass w-full x   max-h-screen ">
//                 <div class="w-4/4 rounded-md min-h-60    items-center m-auto p-5 mb-5" style="background-color: #7CB3B6;">
// <div class="flex items-center" style="font-size: 12px; justify-content: end;"><a onclick="deleteTeamForm()"><b>Groep verwijderen</b><i class=" p-2 fa-solid fa-trash"></i></a></div>
//                     <div class="max-w-full">
//                         <div class="w-5/5 max-h-full">
//                             <div class="text-xl ">
//                                 <div class="vraag-counter  p-2 justify-between items-center">
//                                     <input type="hidden" value="">
//                                     <div class="flex justify-between items-center">
//                                         <div class="w-1/5 m-auto text-center"><b>Groep naam</b></div>
//                                         <input type="text" class="bg-white rounded-md w-3/4 m-2 p-2 " value="Groep ${formCount}" name="group"  required>
//                                     </div>
//                                     <div class="flex justify-between items-center">
//                                         <div class="m-auto text-center w-1/5"><b>E-mail</b></div>
//                                         <input type="text" class="bg-white rounded-md w-3/4 m-2 p-2" value="" name="email" required >
//                                     </div>
//                                 </div>
//
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//             </form>
//                     `

                }
            </script>
            <!--            action="add.team.php?id=--><?php //echo $_GET['id'] ?><!--"-->
            <form action="sendEmail.php?id=<?php echo $_GET['id'];?>"  method="post"  >
                <div class="inputs-container" id="teamForm">
                    <div id="form-count-1">
                        <div class="formclass w-full  max-h-screen ">

                            <div class="w-4/4 rounded-md min-h-60  m  items-center m-auto p-5 mb-5" style="background-color: #7CB3B6;">

                                <div class="max-w-full">
                                    <div class="w-5/5 max-h-full">
                                        <div class="text-xl ">

                                            <div class="vraag-counter  p-2 justify-between items-center">

                                                <input type="hidden" value="">
                                                <div class="flex justify-between items-center">
                                                    <div class="w-1/5 m-auto text-center"><b>Groep naam</b></div>
                                                    <input type="text" class="bg-white rounded-md w-3/4 m-2 p-2 team-counter" value="Groep 1" name="groups[0][group]"  required>

                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <div class="m-auto w-1/5 text-center"><b>E-mail</b></div>
                                                    <input type="text" class="bg-white rounded-md w-3/4 m-2 p-2" value="" name="groups[0][email]" required >
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <a  onclick="addTeamForm()" class="text-center color-red "><div class="text-center ml-auto mr-auto m-5 mt-10 " style="height: 50px; width: 50%;border-radius: 10px;color: #F0F7F4; background-color: #70ABAF;display: flex;justify-content: center;align-items: center;"><i class="fa-solid fa-plus pr-2"></i>Groep Aanmaken</div></a>
                <!--                <button class="m-auto item-center" style="height: 50px; width: 50%;border-radius: 10px; background-color: #78A300;color:white; display: flex;justify-content: center;align-items: center;"><a href="add.team.php?id=--><?php //echo $_GET['id']; ?><!--" class="text-center"><div class="text-center ml-auto mr-auto m-5 " >E-mails versturen<i class="fa-solid fa-arrow-right m-2"></i></div></a></button>-->
                <button class="m-auto item-center"type="submit" style="height: 50px; width: 50%;border-radius: 10px; background-color: #78A300;color:white; display: flex;justify-content: center;align-items: center;"><a href="sendEmail.php?id=<?php echo $_GET['id'];?>" class="text-center"><div class="text-center ml-auto mr-auto m-5 " >E-mail versturen<i class="fa-solid fa-arrow-right m-2"></i></div></a></button>
            </form>

            <style>
                body {
                    /* Set "my-sec-counter" to 0 */
                    counter-reset: my-sec-counter;
                }

                .team-counter::before {
                    /* Increment "my-sec-counter" by 1 */
                    counter-increment: my-sec-counter;
                    content: "Vraag " counter(my-sec-counter) ".";
                }
            </style>







            <?php
            } // while loop brace


            } // isset brace

            else{
                echo "It is not set.";
            }



            ?>


</body>
</html>

