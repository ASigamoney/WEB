<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WatchMe</title>
    <link rel="stylesheet" href="main.css">
</head>
<body id="indexbody">
    <div id="b1"></div>
    <div id="mheader"><h1>Profile</h1></div>
    <?php
    /*echo "Username: " . " " . $_POST["username"] . "<br>"; 
    echo "Password: " . " " . $_POST["password"] . "<br>"; */
    
    $sql = "Select firstname, lastname, dob, sex, phonenumber, marriagestatus, email, city,company,datejoined 
    from watchme.people 
    where username = '" . $_POST["username"] . "'
    and password =  '" . $_POST["password"] . "';";

    //echo "SQL: " . $sql . "<br>";

    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="David@2023";
    $dbname="watchme";
    $sqlresult = 9999;

    $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    $result = $con->query($sql);
    if ($result->num_rows > 0){
        $row = $result ->fetch_assoc();
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $dob = $row["dob"];
        $sex = $row["sex"];
        $phonenumber = $row["phonenumber"];
        $marriagestatus = $row["marriagestatus"];
        $email = $row["email"];
        $city = $row["city"];
        $company = $row["company"];
        $datejoined = $row["datejoined"];    
        
        echo "<div id='prodiv' style='position: absolute;top:30%;left:20%;width:50%;height:50%;'>";
        echo "<table style='width:100%;height:100%;'>";
        echo "<tr><td>Name:</td><td><label>" . $firstname . " " . $lastname . "</label></td></tr>";
        echo "<tr><td>Date of Birth:</td><td><label>" . " " . $dob . "</label><br>";
        echo "<tr><td>Sex:</td><td><label>" . " " . $sex . "</label><br>";
        echo "<tr><td>Contact Number:</td><td><label>" . " " . $phonenumber . "</label><br>";
        echo "<tr><td>Marrige Status:</td><td><label>" . " " . $marriagestatus . "</label><br>";
        echo "<tr><td>E-Mail:</td><td><label>" . " " . $email . "</label><br>";
        echo "<tr><td>City:</td><td><label>" . " " . $city . "</label><br>";
        echo "<tr><td>Company:</td><td><label>" . " " . $company . "</label><br>";
        echo "<tr><td>Date Joined:</td><td><label>" . " " . $datejoined . "</label><br>";
        echo "</table>";
        echo "</div>";
    }
    else
    {

        echo "<h1 style='position: absolute;top:200px;left:100px;'> User Not Found. Please <a href=register.html>Register</a></h1>";
    }
    $con->close();



    ?>
   
</body>
</html>