<?php
include "dbcon.php";
//Get the starttime from opdracht
if (isset($_GET['OpdrachtId'])){
    $selectStartTime="select StartTijd, VerwachtteEindtijd from Opdrachten where  OpdrachtId = $_GET[OpdrachtId]";
    $resultStart = mysqli_query($conn,$selectStartTime);
    $rowStartTime=mysqli_fetch_assoc($resultStart);


    $startTijd = $rowStartTime['StartTijd'];
    $eindTijd = $rowStartTime['VerwachtteEindtijd'];


    $sql = "SELECT * 
FROM User 
WHERE Rol=3 and NOT EXISTS 
    (SELECT * 
     FROM Opdrachten where  
        Time('$eindTijd') between Starttijd and VerwachtteEindtijd and Datum=CURDATE() and Opdrachten.UserId = User.UserId ) and NOT EXISTS 
    (SELECT * 
     FROM Opdrachten where Time('$startTijd') between Starttijd and VerwachtteEindtijd  and Datum=CURDATE() and Opdrachten.UserId = User.UserId ) ";
    $result = mysqli_query($conn,$sql);
    foreach ($result as $row){?>
        <div class="w-4/5 rounded-md min-h-60   bg-yellow-500 items-center m-auto p-5 mb-5" ">
        <a href="updateOpdracht.php?OpdrachtId=<?php echo $_GET['OpdrachtId']; ?>&UserId=<?php echo $row['UserId']; ?>&KamerId=<?php echo $_GET['KamerId']; ?>" onclick="return confirm('Wilt u deze schoonmaakster koppelen?')">
        <div class="max-w-full">
            <div class="w-5/5 max-h-full">
                <div class="text-xl ">
                    <div class="  p-2  justify-between items-center flex" style="align-items: revert;">
                        <div class="text-center m-auto flex  ">

                            <div class="w-5/5 m-auto mr-5 text-center"><b>Schoonmaakster Naam:</b></div>
                            <div><?php echo $row["Naam"]; ?></div>
                        </div>



                    </div>

                </div>
            </div>
        </div>
        </a>
        </div>


        <?php
    }
}










?>