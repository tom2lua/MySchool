<?php
    $servername = "localhost";
    $dbUsername = "Tom2lua";
    $dbPassword = "Hexastudio123";
    $dbname = "myschool";  

    // Create connection
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

    $request = json_decode(file_get_contents('MyClass.php'));

    $name = $request->name;
    $gender = $request->gender;
    $birthday = $request->birthday;
    $phone = $request->phone;

    $sql = "UPDATE student SET name='$name', sex='$gender', birthday='$birthday', phone_number='$phone'";
    $result = $conn->query($sql);

?>