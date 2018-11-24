<!DOCTYPE html>
<html>
<head>
    <title>First Page</title>
</head>
<body>
   <pre>
    <?php 
        print_r($_POST);
     ?>
   </pre>
   <br>
   <?php 
        if (isset($_POST["username"])) {
            $username = $_POST["username"];
        } else {
            $username = "";
        }
        if (isset($_POST["password"])) {
            $password = $_POST["password"];
        } else {
            $username = ""; 
        }

        ?>
    <?php 
        $username = isset($_POST["username"]) ? $username = $_POST["username"] : "";
        $password = isset($_POST["password"]) ? $username = $_POST["password"] : "";
     ?>
     <?php 
        if (isset($_POST["submit"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
        }
        echo "{$username}: {$password}";
      ?>
</body>
</html>