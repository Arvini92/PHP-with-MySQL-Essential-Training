<?php 
    header("HTTP 1.1/ 404 Not Found");
    header("X-Powered-By: PHP/5.4.11");
    /*$logged_in = $_GET['logged_in'];
    if ($logged_in == "1") {
        redirect_to("includes.php");
    } else {
        //redirect_to("https://lynda.com");
    }*/
?>
<?php
    $dbhost = "localhost";
    $dbuser = "widget_cms";
    $dbpass = "secretpassword";
    $dbname = "widget_corp";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (mysqli_connect_errno()) {
        die("Database connection failed: " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
        );
    }
?>
<?php 
    $query = "SELECT * ";
    $query .= "FROM subjects ";
    $query .= "WHERE visible = 1 ";
    $query .= "ORDER BY position ASC";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Database query failed.");
    }
 ?>
<?php 
    $name = "test";
    $value = 45;
    $expire = time() + (60*60*24*7); //add seconds

    ///setcookie($name, $value, $expire);
    //setcookie($name);
    //setcookie($name, null, $expire);
    //setcookie($name, null, time - 3600);

    $_SESSION["first_name"] = "Kevin";
    //$_SESSION["first_name"] = null;
    $name = $_SESSION["first_name"];
    echo $name;
    //session_start();
?>

<?php 
    require_once("included_functions.php");
    require_once("validation_functions.php");
    /*if (isset($_POST["submit"])) {

        $username = $_POST["username"];
        $password = $_POST["password"];
        if($username == "kevin" && $password == "secret") {
            redirect_to("includes.php");
        } else {
            $messege = "There was some errors";
        }
        //$messege = "Logging in: {$username}";
    } else {
        $username = "";
        $messege = "Please log in.";
    }*/
    $errors = array();
    $messege = "";

    if (isset($_POST["submit"])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        $fields_required = array("username", "password");
        foreach($fields_required as $field) {
            $value = trim($_POST[$field]);
            if (!has_presence($value)) {
                $errors[$field] = ucfirst($field) . " can't be blank";
            }
        }

        $fields_with_max_lenghts = array("username" => 30, "password" => 8);
        validate_max_lenghts($fields_with_max_lenghts);

        if (empty($errors)) {
            if($username == "kevin" && $password == "secret") {
                redirect_to("includes.php");
            } else {
                $messege = "Username/password do not match";
            }
        }
    }
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>Main Page</title>
</head>
<body>
    <a href="first_page.php">First Page</a>
    <br>
    <?php $link_name = "Second Page"; ?>
    <?php $id = 2; ?>
    <?php $company = "Johnson & Johnson"; ?>

    <a href="second_page.php?id=<?php echo $id; ?>
    &company=<?php echo rawurlencode($company);  ?>"
    ><?php echo $link_name ?></a>
    <br>
    <?php $linkText = "<Click> & learn more" ?>
    <a href="">
        <?php echo htmlspecialchars($linkText); ?>
    </a>
    <br>
    <?php 
        $text = "";
        echo htmlentities($text);
     ?>
     <?php 
        //$url = "http://localhost/";
        //$url .= rawurldecode();
        //$url .= "?" . "param1=" .urldecode();
        //$url .= "$" . "param1=" .urldecode();
      ?>
      <pre>
        <?php print_r(headers_list()); ?>
      </pre>
      <br>

      <!-- <form action="form_processing.php" method="post">
        Username: <input type="text" name="username" value=""><br>
        Password: <input type="password" name="password" value=""><br>
        <br>
        <input type="submit" name="submit" value="Submit">
      </form> -->
        <?php echo $messege; ?><br>
        <?php echo form_errors($errors); ?>
      <form action="index.php" method="post">
        Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>"><br>
        Password: <input type="password" name="password" value=""><br>
        <br>
        <input type="submit" name="submit" value="Submit">
      </form>
        <?php 
            $value = trim(""); // "0" // 0
            if (!isset($value) || empty($value) && !is_numeric($value)) {
                echo "Validation failed.<br>";
            }
            if (!isset($value) || $value=="") {
                echo "Validation failed.<br>";
            }
            $value = "";
            $min = 3;
            if (strlen($value) < $min) {
                echo "Validation failed.<br>";
            }
            $max = 3;
            if (strlen($value) < $max) {
                echo "Validation failed.<br>";
            }
            $value = "";
            if (!is_string($value)) {
                echo "Validation failed.<br>";
            }

            $value = "";
            $set = array("1", "2", "3", "4");
            if (!in_array($value, $set)) {
                echo "Validation failed.<br>";
            }

            if (preg_match("/PHP/", "PHP is fun.")) {
                echo "A mach was found<br>";
            } else {
                echo "A mach was not found<br>";
            }
            $value = "nobody@nowhere.com";
            if (!preg_match("/@/", $value)) {
                echo "Validation failed.<br>";
            }
            if (strpos($value, "@") === false) {
                echo "Validation failed.<br>";
            }

            $errors = array();
            $value = trim(""); // "0" // 0
            if (!isset($value) || empty($value) && !is_numeric($value)) {
                $errors['value'] = "Value can't be blank";
            }
            if (!has_presence($username)) {
                $errors['username'] = "Username can't be blank";
            }
         ?>
         <?php 
         /*if(!empty($errors)){
            //redirect_to("includes.php");
            include("index.php");
         } else {
            include("success.php");
         }*/
        ?>
        <?php 
            echo form_errors($errors);
         ?>

         <pre>
            <?php 
                $test = isset($_COOKIE["test"]) ? $_COOKIE["test"] : "";
                echo $test;
            ?>
         </pre>
         <ul>
            <?php 
                while($subject = mysqli_fetch_assoc($result)) {
            ?>
                    <li>
                        <?php echo $subject["menu_name"] . " (" .
                            $subject["id"] . ")"; ?>
                    </li>
            <?php   
                }
            ?>
          </ul>
          <?php 
            mysqli_free_result($result);
           ?>

           <?php 
                $menu_name = "Today's Widget Trivia";
                $position = (int) 4;
                $visible = (int) 1;

                $menu_name = mysqli_real_escape_string($connection, $menu_name);

                $query = "INSERT INTO subjects (";
                $query .= " menu_name, position, visible";
                $query .= ") VALUES (";
                $query .= " '{$menu_name}', {$position}, {$visible}";
                $query .= ")";
             
                 $result = mysqli_query($connection, $query);

                if ($result) {
                    echo "Success!";
                } else {
                    die("Database query failed. " . mysqli_error($connection));
                }
            ?>

            <?php
                $id =  5;
                $menu_name = "Delete me";
                $position = 4;
                $visible = 1;

                $query = "UPDATE subjects SET ";
                $query .= "menu_name = '{$menu_name}', ";
                $query .= "position = {$position}, ";
                $query .= "visible = {$visible} ";
                $query .= "WHERE id = {$id}";
             
                 $result = mysqli_query($connection, $query);

                if ($result && mysqli_affected_rows($connection) == 1) {
                    echo "Success!";
                } else {
                    die("Database query failed. " . mysqli_error($connection));
                }
            ?>

             <?php
                $id =  5;
               
                $query = "DELETE FROM subjects ";
                $query .= "WHERE id = {$id} ";
                $query .= "LIMIT 1";
             
                $result = mysqli_query($connection, $query);

                if ($result && mysqli_affected_rows($connection) == 1) {
                    echo "Success!";
                } else {
                    die("Database query failed. " . mysqli_error($connection));
                }
            ?>

</body>
</html>

<?php 
    mysqli_close($connection);
 ?>