<?php

class database {
    // sql config
    private $conn = "";
    private $hostname = "localhost";
    private $username  = "root";
    private $password = "";
    private $dbname = "demo";

    public function __construct() {
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function getAllData(){
        $select = $this->conn->prepare("SELECT * FROM data");
        if($select -> execute()){
            $res = $select->get_result();
            $select -> close();
            return $res;
        }
    }

    public function getData($id){
        $select = $this->conn->prepare("SELECT * FROM data WHERE id=?");
        $select->bind_param("s", $id);
        if($select -> execute()){
            $res = $select->get_result();
            $resArray = $res->fetch_assoc();
            $select -> close();
            return $resArray;
        }else{
            die("not found or something went wrong");
        }   
    }


    public function delete($id){
        $delete = $this->conn->prepare("DELETE FROM `data` WHERE `id`=?");
        $delete->bind_param("s", $id);
        if($delete -> execute()){
            $delete -> close();
        }else{
            die("unable to delete or something went wrong");
        }  
    }



    public function update($id, $name, $email, $password, $gender, $lang, $status, $imagename){
        $insert = $this->conn->prepare("UPDATE `data` SET `name`=?, `email`=?, `password`=?, `gender`=?, `language`=?, `status`=?, `profile`=? WHERE `id`=? LIMIT 1");
        $insert->bind_param("ssssssss", $name, $email, $password, $gender, $lang, $status, $imagename, $id);

        try{
            $insert->execute();
        }
        catch(Exception $e){
            throw("Error: "+ $e);
        }
        finally{
            $insert->close();
        }
    }


    public function save($name, $email, $password, $gender, $lang, $status, $imagename ){
        $insert = $this->conn->prepare("INSERT INTO `data` (`name`, `email`, `password`, `gender`, `language`, `status`, `profile`) VALUES (?,?,?,?,?,?,?)");
        $insert->bind_param("sssssss", $name, $email, $password, $gender, $lang, $status, $imagename);

        try{
            $insert->execute();
        }
        catch(Exception $e){
            throw("Error: "+ $e);
        }
        finally{
            $insert->close();
        }
    }

}

