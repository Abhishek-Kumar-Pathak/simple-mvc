<?php

require("model.php");


function handleImageFile($is_update = false){
    if(isset($_FILES)){
        $fullname = $_FILES["profilepic"]["name"];
        $extension = strtolower(pathinfo($fullname, PATHINFO_EXTENSION));
        if($extension != "jpg" && $extension != "png" && $extension != "jpeg"){
            return false;
        }else{
            $newname =  pathinfo($fullname, PATHINFO_FILENAME)."-".bin2hex(random_bytes(3)).".".pathinfo($fullname, PATHINFO_EXTENSION);
            $tempname = $_FILES["profilepic"]["tmp_name"];
            if(move_uploaded_file($tempname, "profiles/".$newname)){
                // delete old pic if exist
                if($is_update && file_exists($is_update)){
                    unlink($is_update);
                }
                return $newname;
            }
        }
    }
    return false;
}

if(isset($_GET) && isset($_GET['action'])) {
    // route
    if($_GET["action"] == "add-data"){
        require("view/add.php");  // or function call
    }
    else if($_GET["action"] == "update-data"){
        require("view/update.php");
    }
    else if($_GET["action"] == "delete-data"){
        $db = new database();
        $db->delete($_GET["id"]);
        header("location: /");
    }
    else if($_GET["action"] == "view-data"){
        require("view/all-data.php");
    }
}else{
    require("view/all-data.php");
}




?>