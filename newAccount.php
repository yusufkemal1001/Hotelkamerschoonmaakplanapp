<?php 

?>


<form action="sendEmail.php" method="post" class="m-auto text-center w-1/4">
    <div class="text-xl">Account aanmaken</div>
    Naam:<input type="text" name="gebruiker[0][naam]" class=" m-5" style="border: 1px solid;border-radius: 5px;"><br>
    E-mail:<input type="email" name="gebruiker[0][email]" class=" m-5" style="border: 1px solid;border-radius: 5px;">
    <div class="flex justify-around ">
        <div>
            <input type="radio" id="beheerder" name="gebruiker[0][rol]" value="2">
            <label for="beheerder">Beheerder</label><br>
        </div>
        <div>
            <input type="radio" id="schoonmaakster" name="gebruiker[0][rol]" value="3">
            <label for="schoonmaakster">Schoonmaakster</label><br>
        </div>
    </div>
    <button class="bg-blue-300 p-2 rounded-md m-5" ><div class="text-center " style=" border-radius: 10px;color: #000; align-items: center;">Account aanmaken</div></button>
</form>
