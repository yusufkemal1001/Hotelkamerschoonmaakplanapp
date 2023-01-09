<?php
include 'dbcon.php';


//require 'db.php';

$select = new Select();

if (isset($_SESSION["id"])) {
    $user = $select->selectUserById($_SESSION["id"]);
} else {
    header("location: index.php");
}

$countTime = "SELECT SUM(Duur)
FROM Taken_Van_Kamer;";

$resultCount = $conn->query($countTime);

$sql = "Select Taken.Taak,Taken.TaakId, Taken_Van_Kamer.Duur, KamerId from Taken_Van_Kamer inner join Taken on Taken_Van_Kamer.TaakId = Taken.TaakId where Taken_Van_Kamer.KamerId=$_GET[KamerId] and Taken.Vast='1';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $vastTaakId = $row['TaakId'];
        ?>


        <div class="w-3/5 rounded-md min-h-60   bg-yellow-500 items-center m-auto p-5 mb-5" ">

        <div class="max-w-full">
            <div class="w-5/5 max-h-full">
                <div class="text-xl ">
                    <div class="  p-2 justify-between items-center flex" style="align-items: revert;">
                        <input type="hidden" value="">
                        <div class="flex justify-between items-center">
                            <div class="w-5/5 mr-5 m-auto text-center"><b>Taak</b></div>
                            <?php echo $row["Taak"]; ?>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="m-auto text-center w-5/5 mr-5"><b>Duur(min)</b></div>
                            <input type="hidden" name="taak[<?php echo $vastTaakId; ?>][taakId]"
                                   value="<?php echo $vastTaakId; ?>">
                            <input type="number" class="rounded-md m-auto flex "
                                   style="color: black; border: 1px solid;"
                                   value=<?php echo $row['Duur']; ?> name="taak[<?php echo $vastTaakId; ?>][duur]"
                                   min="1" required/><br>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        </div>

        <?php
    }
    $sql1 = "Select Taken.Taak,Taken.TaakId, Taken_Van_Kamer.Duur, KamerId from Taken_Van_Kamer inner join Taken on Taken_Van_Kamer.TaakId = Taken.TaakId where Taken_Van_Kamer.KamerId=$_GET[KamerId] and Taken.Vast='0';";
    $result = $conn->query($sql1);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row1 = $result->fetch_assoc()) {
            $TaakId = $row1['TaakId'];

            ?>


            <div class="w-3/5 rounded-md min-h-60   bg-blue-300 items-center m-auto p-5 mb-5" ">

            <div class="max-w-full">
                <div class="w-5/5 max-h-full">
                    <div class="text-xl ">
                        <div class="  p-2 justify-between items-center flex" style="align-items: revert;">
                            <input type="hidden" value="">
                            <div class="flex justify-between items-center">

                                <input type="hidden" name="taak[<?php echo $TaakId; ?>][taakId]"
                                       value="<?php echo $TaakId; ?>">
                                <div class="w-5/5 mr-5 m-auto text-center"><b>Taak</b></div>
                                <input type="text" class="rounded-md" name="taak[<?php echo $TaakId; ?>][naam]"
                                       style="border: 1px solid;" value="<?php echo $row1["Taak"]; ?>">

                            </div>
                            <div class="flex justify-between items-center">
                                <div class="m-auto text-center w-5/5 mr-2"><b>Duur(min)</b></div>
                                <input type="hidden" name="taak[<?php echo $TaakId; ?>][taakId]"
                                       value="<?php echo $TaakId; ?>">
                                <input type="number" class="w-1/2 rounded-md m-auto flex "
                                       style="color: black; border: 1px solid;" value='<?php echo $row1['Duur']; ?>'
                                       name="taak[<?php echo $TaakId; ?>][duur]" min="1" required/><br>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="deleteTaak.php?TaakId=<?php echo $TaakId; ?>&KamerId=<?php echo $_GET['KamerId']; ?>"><i
                                            class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>

            <?php
        }
    }

} else {
    ?>
    <div class="bg-red-400 w-4/4 m-auto p-2 rounded-md mb-5" style="display: block;
    left: 63%;
    width: 100%;
    position: relative;">
        <div class="text-center text-white text-2xl"><?php echo "Er zijn geen taken"; ?></div>
    </div>
    <?php
}
$conn->close();
?>

<script>
    function showAddButton() {

    }

    let formCount = 1;

    function addTeamForm() {
        const form = document.querySelector("#teamForm")
        const div = document.createElement("div")
        const formCountClone = formCount
        div.id = "form-count-" + formCountClone
        console.log(formCount)
        div.innerHTML = `
                <div class="w-3/5 rounded-md min-h-60    items-center m-auto p-5 mb-5" style="background-color: #7CB3B6;">

                    <div class="max-w-full">
                        <div class="w-5/5 max-h-full">
                            <div class="text-xl ">
                                <div class="vraag-counter  p-2 justify-between items-center flex" style="align-items: revert;">
                                    <input type="hidden" value="">
                                    <div class="flex justify-between items-center">
                                        <div class="w-1/5 m-auto text-center mr-2"><b>Nieuwe Taak</b></div>
                                        <input type="text" class="bg-white rounded-md w-3/4 m-2  " style="border: 1px solid;" value="Taak ${formCount}" name="nieuweTaak[${formCount}][naam]"  required>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="m-auto text-center w-1/5"><b>Duur(min)</b></div>
                                        <input type="number" class="bg-white rounded-md w-2/4 m-2 " style="border: 1px solid;" value="30" name="nieuweTaak[${formCount}][duur]" required >
                                    </div>

                                    <div class="flex items-center" style="cursor: pointer; ">
                                        <a onclick="deleteTeamForm(${formCountClone})"><b></b><i class="fa-regular fa-trash-can"></i>
                                        </a>
                                    </div>


                            </div>
                        </div>
                    </div>
                </div>


                    `
        formCount++;
        form.appendChild(div)


    }

    function deleteTeamForm(formCount1) {
        const div = document.getElementById("form-count-" + formCount1)
        formCount--
        div.parentNode.removeChild(div)

        console.log(formCount)
        console.log()

        if (formCount1 === 1) {
            const box = document.getElementById('add');
            box.style.display = 'none';
        }

    }

</script>


<div class="inputs-container" id="teamForm">

</div>
<div id="newTaak" onclick="addTeamForm()">
    <a class="text-center color-red ">
        <div class="text-center ml-auto mr-auto m-5 mt-5 "
             style="border: 1px solid; cursor: pointer; color: black; height: 50px; width: 20%;border-radius: 10px; display: flex;justify-content: center;align-items: center;">
            <i class="fa-solid fa-plus pr-2"></i>Taak Aanmaken
        </div>
    </a>
</div>


