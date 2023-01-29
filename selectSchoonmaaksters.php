<?php
include 'dbcon.php';


//require 'db.php';

$select = new Select();

if (isset($_SESSION["id"])){
    $user = $select->selectUserById($_SESSION["id"]);
}else{
    header("location: index.php");
}

$sql = "SELECT * FROM User where rol=3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {?>


        <div class="m-auto w-3/4  rounded-md  bg-slate-500 text-white  max-h-80 h-20 p-5 mb-5 mt-5" >

            <div class=" max-h-full ">
                <div class="w-5/5 ">
                    <div class="text-center w-5/5  items-center text-2xl ">
                        <div class="text-center">
                            <?php echo $row["Naam"];?>
                            <div  style="float: right">
                                <a onclick="return confirm('Wilt u deze account verwijderen?')" href="deleteUser.php?UserId=<?php echo $row['UserId'] ?>"><i class="mt-2 fa-regular fa-trash-can"></i></a>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <?php
    }

} else {
    ?>
    <div class="bg-red-400 w-4/4 m-auto p-2 rounded-md mb-5 mt-5" style="display: block;

    width: 80%;
    position: relative;">
        <div class="text-center text-white text-2xl"><?php echo "Er zijn geen schoonmaak(st)ers";?></div>
    </div>
    <?php
}
$conn->close();
?>