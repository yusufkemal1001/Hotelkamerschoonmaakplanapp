<?php
include 'db.php';
class login extends Dbh{
    public $id;
    public $role;
    public function login($email,$password){
        $stmt = mysqli_prepare($this->conn, "Select * FROM User WHERE Email = ? ;");
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();



        if ($result->num_rows > 0){
            if ($password==$row["Wachtwoord"]){
                $this->id=$row["UserId"];
                $this->role=$row["Rol"];
                return 1;
            }
            else{
                return 10;
            }
        }
        else{
            return 100;
        }
    }
    public function idUser(){
        return $this->id;

    }
    public function rolUser(){
        return $this->role;
    }
}
class Select extends Dbh{
    public function selectUserById($id){
        $result = mysqli_query($this->conn, "SELECT * FROM User WHERE UserId='$id'");
        return mysqli_fetch_assoc($result);
    }
}