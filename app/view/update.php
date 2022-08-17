<?php

echo "<a href='/'>Go Back</a><br/>";
$db = new database();
$data = $db->getData($_GET['id']);
$langsArray = explode(",", $data["language"]);

if (isset($_POST["submit"])) {
    $langs = implode(",", $_POST["language"]);

    $db = new database();
    $profile = handleImageFile($data['profile']);
    if($profile){
        $db->update($_GET["id"], $_POST["name"], $_POST["email"], $data["password"], $_POST["gender"], $langs,  $_POST["status"], $profile);
    }else{
        $db->update($_GET["id"], $_POST["name"], $_POST["email"], $data["password"], $_POST["gender"], $langs,  $_POST["status"], $data['profile']);
    } 
    echo "<h2 style='color:green'> updated successfully </h2>"; 
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>

<body>



    <form action="/?action=update-data&id=<?php echo $_GET['id'] ?>" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Enter Your Name" value="<?php echo $data['name'] ?>" required><br />
        <input type="email" name="email" placeholder="Enter Your email address" value="<?php echo $data['email'] ?>"><br />

        <input type="radio" name="gender" value="Male" <?php echo $data["gender"] == "Male" ? "checked" : "" ?> required>Male <br />
        <input type="radio" name="gender" value="Female" <?php echo $data["gender"] == "Female" ? "checked" : "" ?> >Female <br />
        <h3>Languages</h3>
        <input type="checkbox" name="language[]" value="Hindi" <?php echo (in_array("Hindi", $langsArray, true) == true) ? "checked" : ""; ?> >Hindi <br />
        <input type="checkbox" name="language[]" value="English" <?php echo (in_array("English", $langsArray, true) == true) ? "checked" : ""; ?>>English <br />
        <input type="checkbox" name="language[]" value="Urdu" <?php echo (in_array("Urdu", $langsArray, true) == true) ? "checked" : ""; ?>>Urdu <br />
        <input type="checkbox" name="language[]" value="Telgu" <?php echo (in_array("Telgu", $langsArray, true) == true) ? "checked" : ""; ?>>Telgu <br />

        <h3>Profession</h3>
        <select name="status">
            <option value="Student" <?php echo $data["status"] == "Student" ? "selected" : "" ?>>Student</option>
            <option value="Self Employeed" <?php echo $data["status"] == "Self Employeed" ? "selected" : "" ?>>Self Employeed</option>
            <option value="Employeed" <?php echo $data["status"] == "Employeed" ? "selected" : "" ?>>Employeed</option>
        </select> <br />

        <h3>Upload Profile Image</h3>
        <input type="file" name="profilepic"> <br/><br/>

        <input type="submit" name="submit" value="Submit">

    </form>



</body>

</html>