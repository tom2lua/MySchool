<?php
$username = $pass = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $username = test_input($_POST["username"]);
        $pass = test_input($_POST["pass"]);
    }

    function test_input($str)
    {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
?>