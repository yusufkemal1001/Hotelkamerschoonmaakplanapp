<?php
include "dbcon.php";


$sql = "select OpdrachtId,UserId,KamerId,Starttijd,Eindtijd,VerwachtteEindtijd,Notificatie,DATE_FORMAT(Datum,'%d-%m-%Y') as Datum,Opmerking from Opdrachten where Eindtijd is Not Null and Datum = CURDATE()  order by OpdrachtId  desc  ";


foreach (mysqli_query($conn, $sql) as $lastMelding) {






    $newKamerMelding = "select Naam from Kamers where KamerId=$lastMelding[KamerId] ";
    $resultNewMelding = mysqli_query($conn, $newKamerMelding);
    $rowNewMelding = mysqli_fetch_assoc($resultNewMelding);

        $array = unserialize($lastMelding['Notificatie']);

    if ((in_array($_SESSION['id'], $array)) !== false) { ?>
        <div class="parentDiv" id="parentDiv">

            <?php if ($lastMelding['Eindtijd'] > $lastMelding['VerwachtteEindtijd']) { ?>
                <div class="" style="padding: 5px;">
                    <i class="fa-solid fa-circle-exclamation text-red-500 mr-2"></i></i><?php echo $rowNewMelding['Naam']; ?> is schoongemaakt!
                    <a class="cursor-pointer" onclick="deleteNotification(<?php echo $lastMelding['OpdrachtId']; ?>,this) " style="float: right;"><i class="fa-regular fa-trash-can"></i></a>
                </div>
            <?php } else { ?>
                <div  class="" style="padding: 5px;">

                    <?php echo $rowNewMelding['Naam']; ?> is schoongemaakt!
                    <a class="cursor-pointer" onclick="deleteNotification(<?php echo $lastMelding['OpdrachtId']; ?>,this) "style="float: right"><i class="fa-regular fa-trash-can"></i></a>
                </div>
            <?php } ?>

        </div>
    <?php }


}
?>

<!--<script>-->
<!--    const parentDiv = document.querySelector(".parentDiv");-->
<!---->
<!--    if (parentDiv.childElementCount > 0) {-->
<!--        console.log(`There are ${parentDiv.childElementCount} child elements.`);-->
<!---->
<!--    } else {-->
<!--        parentDiv.innerHTML = "There are no child elements.";-->
<!---->
<!--    }-->
<!--</script>-->
<script>
    // select the button element

    // add an event listener to the button
    function deleteNotification(OpdrachtId,element) {


        // update the array

        element.parentElement.parentElement.remove();
        // make an AJAX call to the PHP script
        $.ajax({
            type: "POST",
            url: "deleteNotification.php?OpdrachtId=" + OpdrachtId,

            success: function (response) {
                console.log(response);
            }
        });const noChildrenText = document.getElementById("noChildrenText");
        const parentDiv = document.querySelector("#parentDiv");
        const childDivs = parentDiv.querySelectorAll("div");
        const childDivCount = childDivs.length;
        const dot = document.getElementById("dot")
        console.log(childDivCount);
        if (childDivCount === 0) {
            noChildrenText.style.display = "block";
            dot.style.display = "none";
            // parentDiv.innerHTML = "There are no child divs.";

        } else {
            noChildrenText.style.display = "none";
            dot.style.display = "block";
        }
    };


</script>


