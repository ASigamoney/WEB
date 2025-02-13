<?php
echo "Username: " . " " . $_POST["username"] . "<br>"; 
echo "Password: " . " " . $_POST["password"] . "<br>"; 

$sql = "Select firstname, lastname, dob, sex, phonenumber, marriagestatus, email, city,company,datejoined 
        from watchme.people 
        where username = '" . $_POST["username"] . "'
        and password =  '" . $_POST["password"] . "';";

        echo "SQL: " . $sql . "<br>";

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
            
            echo "Firstname: " . " " . $firstname . "<br>";
            echo "lastname: " . " " . $lastname . "<br>";
            echo "dob: " . " " . $dob . "<br>";
            echo "sex: " . " " . $sex . "<br>";
            echo "phonenumber: " . " " . $phonenumber . "<br>";
            echo "marriagestatus: " . " " . $marriagestatus . "<br>";
            echo "email: " . " " . $email . "<br>";
            echo "city: " . " " . $city . "<br>";
            echo "company: " . " " . $company . "<br>";
            echo "datejoined: " . " " . $datejoined . "<br>";
        }
        $con->close();

        

        





