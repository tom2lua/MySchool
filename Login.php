<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="loginCss.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    </head>
    <body>
        
        <p class="header">MySchool</p>
        <div class="main">
            <form class="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <h2>Login</h2>
                <label for="username">Username</label>
                <input type="text" id="name" name="username" placeholder="Username" required>
                <label for="pass">Password</label>
                <input type="password" id="pass" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
        </div>
        <?php
            $username = $pass = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $username = test_input($_POST["username"]);
                $pass = test_input($_POST["password"]);

                $servername = "localhost";
                $dbUsername = "Tom2lua";
                $dbPassword = "Hexastudio123";
                $dbname = "myschool";  

                // Create connection
                $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

                $sql = "SELECT user_id FROM users WHERE username = '$username' AND password = '$pass'";
                $result = $conn->query($sql);

                $rs = $result->fetch_assoc();
                if ($rs !== null)
                {
                    header("Location: MyClass.php");
                    exit();
                }
            }
            function test_input($str)
            {
                $str = trim($str);
                $str = stripslashes($str);
                $str = htmlspecialchars($str);
                return $str;
            }
        ?>
        <script>
            var myApp = angular.module('loginApp', []);
        </script>
    </body>
</html>