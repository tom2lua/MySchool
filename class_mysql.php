<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $servername = "localhost";
    $username = "Tom2lua";
    $password = "Hexastudio123";
    $dbname = "myschool";  

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT class_id, class_code, class_name FROM class";
    $result = $conn->query($sql);

    $myOutput = "";
    while($rs = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        if ($myOutput != "") {$myOutput .= ",";}
        $myOutput .= '{"ID":"' . $rs["class_id"] . '",';
        $myOutput .= '"Code":"' . $rs["class_code"] . '",';
        $myOutput .= '"Name":"' . $rs["class_name"] . '"}';
    }

    $myOutput = '{"records":['.$myOutput.']}';
    $conn->close();     

    echo($myOutput);
?>