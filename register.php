
<?php
/*echo "First name: " . $_POST["firstname"] . "<br>";
echo "Last Name: " . $_POST["lastname"] . "<br>";*
echo "DOB: " . $_POST["dob"] . "<br>";
echo "Sex: " . $_POST["sex"] . "<br>";
echo "Marriage Status: " . $_POST["marriagestatus"] . "<br>";
echo "Email: " . $_POST["email"] . "<br>";
echo "Phone Number: " . $_POST["phonenumber"] . "<br>";
echo "City: " . $_POST["city"] . "<br>";
echo "Company: " . $_POST["company"] . "<br>";
echo "Username: " . $_POST["username"] . "<br>";
echo "Password: " . $_POST["password"] . "<br>";*/

$errorcode =0;

if ($_POST["firstname"] ==""){
    echo "Error: 0001-First name is missing.";
    $errorcode++;
}
if ($_POST["lastname"]==""){
    echo "Error: 0002-Last name is missing.";
    $errorcode++;
}
//echo "DOBbefore: " . $_POST["dob"] . "<br>";
if ($_POST["dob"] ==""){
    echo "Error: 0003- Date of Birth is missing.";
    $errorcode++;
}
//echo "DOBafter: " . $_POST["dob"] . "<br>";
if ($_POST["username"] ==""){
    echo "Error: 0004- Username is missing.";
    $errorcode++;
}
if ($_POST["password"] ==""){
    echo "Error: 0005- Password is missing.";
    $errorcode++;
}

$emailresult = validateemail($_POST["email"]);
if ($emailresult == false){
    echo "Error: 0004-Invalid E-Mail Address";
    $errorcode++;
}
//phone 000 000 0000
if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $_POST["phonenumber"])) {
     echo "PREG-Error: zzzz-Invalid phone number: ========>" . $_POST["phonenumber"] . "<br>";
  }

$is_phone_number = true;
$is_phone_number = validatephoneno($_POST["phonenumber"]);
if($is_phone_number == false){
   echo "Error: 0005-Invalid phone number: " . $is_phone_number . "========>" . $_POST["phonenumber"] . "<br>";
   $errorcode++;
}

//echo "DOB: " . $_POST["dob"] . "<br>";
$dobdd = substr($_POST["dob"],0,2);
$dobmm = substr($_POST["dob"],3,3);
$dobyy = substr($_POST["dob"],7,4);
$dobmm = getmonthval($dobmm);
$dob = $dobyy . "-" . $dobmm . "-" . $dobdd . " " . "00:00:00";

//echo "DOB: ==========>" . $dob ;
if ($errorcode == 0){

    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="David@2023";
    $dbname="watchme";
    $sqlresult = 9999;

    $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error());

    $sql = "insert into watchme.people (firstname, lastname, dob, sex,marriagestatus,email,phonenumber,city,company,datejoined,username,password) values ('" . $_POST["firstname"] ."','". $_POST["lastname"] . "','" . $dob . "','" . $_POST["sex"] . "','" . $_POST["marriagestatus"] . "','" . $_POST["email"] . "','" . $_POST["phonenumber"] . "','" . $_POST["city"] . "','" . $_POST["company"] . "','" . date('Y-m-d H:i:s') . "','" . $_POST["username"] . "','" . $_POST["password"] . "');";
    // echo "MYSQL: " . $sql;
    if ($con->query($sql) === TRUE) {
        $errorcode ="0";
    } else {
        echo  (string)"Error: " . $sql . "<br>" . $con->error;
        $errorcode++;
    }
    if ($errorcode == 0){
        header("Location: profile.html");
       exit;
    }

    $con->close();
}


function getmonthval($month){
    if($month == "Jan"){
        return "01";
    }
    if($month == "Feb"){
        return "02";
    }
    if($month == "Mar"){
        return "03";
    }
    if($month == "Apr"){
        return "04";
    }
    if($month == "May"){
        return "05";
    }
    if($month == "Jun"){
        return "06";
    }
    if($month == "Jul"){
        return "07";
    }
    if($month == "Aug"){
        return "08";
    }
    if($month == "Sep"){
        return "09";
    }
    if($month == "Oct"){
        return "10";
    }
    if($month == "Nov"){
        return "11";
    }
    if($month == "Dec"){
        return "12";
    }
    
}
function validatephoneno($num){

    if (substr($num,0,1) != "0"){
        echo "return 1: " . substr($num,0,1) . "<br>";
        return false;       
    }
    if(strlen($num) != 10){
        echo "return 2: " . strlen($num) . "<br>";
        return false;
    }
    if(is_numeric($num)){
        return true;
    }
    //echo "DONE! " . $num   . " =========>" . !is_numeric($num) . " " . "<br>";
}
function validateemail($inemail){
    $val = true;
    $val = str_contains($inemail,"@");
    $val = str_contains($inemail,".");
    return $val;
}
?>