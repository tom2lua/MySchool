<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $servername = "localhost";
    $username = "Tom2lua";
    $password = "Hexastudio123";
    $dbname = "myschool";  

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT ref_class_id, name, sex, birthday, phone_number FROM student";
    $result = $conn->query($sql);

    $myOutput = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        if ($myOutput != "") {$myOutput .= ",";}
        $myOutput .= '{"Class":"' . $rs["ref_class_id"] . '",';
        $myOutput .= '"Name":"' . $rs["name"] . '",';
        $myOutput .= '"Sex":"' . $rs["sex"] . '",';
        $myOutput .= '"Birthday":"' . $rs["birthday"] . '",';
        $myOutput .= '"Phone":"' . $rs["phone_number"] . '"}';
    }

    $myOutput = '{"records":['.$myOutput.']}';
    $conn->close();     

    echo($myOutput);
?>