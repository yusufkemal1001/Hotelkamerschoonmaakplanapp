<?php
include "dbcon.php";
$sql = "select User.Naam as name, Kamers.Naam,Opdrachten.Starttijd,Opdrachten.VerwachtteEindtijd,Opdrachten.Datum from User inner join Opdrachten on User.UserId = Opdrachten.UserId inner join Kamers on Kamers.KamerId = Opdrachten.KamerId where Datum=CURDATE() and  VerwachtteEindtijd > CURTIME() order by VerwachtteEindtijd asc limit 3";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 1){
foreach (mysqli_query($conn,$sql) as $row) {

    ?>
    <link rel="stylesheet" href="dist/output.css">
    <div class="w-5/5 rounded-md min-h-60   bg-red-400  items-center m-auto p-5 mb-5" ">
    <div class="max-w-full">
        <div class="w-5/5 max-h-full">
            <div class="text-l ">
                <div class="  p-2  " style="align-items: revert;">
                    <div class=" grid grid-cols-2 text-center m-auto  ">
                        <div class="w-5/5 m-auto m-auto flex text-center"><b>Schoonmaak(st)er Naam:</b>
                            <div class="ml-2"><?php echo $row['name']; ?></div>
                        </div>
                        <div class="w-5/5 m-auto m-auto flex text-center"><b>Kamer:</b>
                            <div class="ml-2"><?php echo $row['Naam']; ?></div>
                        </div>

                        <div class="w-5/5 m-auto flex  m-auto text-center"><b>Starttijd:</b>
                            <div class="ml-2"><?php echo $row["Starttijd"]; ?></div>
                        </div>

                        <div class="w-5/5 m-auto flex m-auto text-center"><b>Verwachtte eindtijd:</b>
                            <div class="ml-2"><?php echo $row["VerwachtteEindtijd"]; ?></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php }


}else{
    echo "sup";
}


?>

