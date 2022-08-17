<?php

echo "<a href='/'>Go back</a>";

if(isset($_POST["submit"])){
    $langs = implode(",", $_POST["language"]);
    
    $db = new database();
    $profile = handleImageFile(false);
    if($profile){
        $db->save($_POST["name"], $_POST["email"], $_POST["password"], $_POST["gender"], $langs,  $_POST["status"], $profile);
        echo "<h2 style='color:green'> Added successfully </h2>";
    }else{
        $db->save($_POST["name"], $_POST["email"], $_POST["password"], $_POST["gender"], $langs,  $_POST["status"], "");
        echo "<h2 style='color:blue'> Added successfully but unable to upload profile pic </h2>";
    }  
    
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD MVC using PHP v7.4</title>
</head>

<body>


    <div>
        <form action="/?action=add-data" method="POST" name="add" id="add" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Enter Your Name" required><br />
            <input type="email" name="email" placeholder="Enter Your email address" required><br />
            <input type="password" name="password" placeholder="Enter the password" required><br />
            <input type="radio" name="gender" value="Male">Male <br />
            <input type="radio" name="gender" value="Female">Female <br />
            <h3>Languages</h3>
            <input type="checkbox" name="language[]" value="Hindi" checked>Hindi <br />
            <input type="checkbox" name="language[]" value="English">English <br />
            <input type="checkbox" name="language[]" value="Urdu">Urdu <br />
            <input type="checkbox" name="language[]" value="Telgu">Telgu <br />

            <h3>Profession</h3>
            <select name="status">
                <option value="Student">Student</option>
                <option value="Self Employeed">Self Employeed</option>
                <option value="Employeed">Employeed</option>
            </select> <br/>

            <h3>Upload Profile Image</h3>
            <input type="file" name="profilepic" required> <br/><br/>

            <input type="submit" name="submit" value="Submit">

        </form>
    </div>

</body>

</html>