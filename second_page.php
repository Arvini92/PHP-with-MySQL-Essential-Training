<!DOCTYPE html>
<html>
<head>
    <title>First Page</title>
</head>
<body>
    <a href="first_page.php">First Page</a>
    <br>
    <a href="index.php">Main Page</a>

    <pre>
        <?php 
            //print_r($_GET) 
        ?>
    </pre>
    <?php 
        $id = $_GET['id'];
        echo $id;
    ?>
    <br>
    <?php 
        $company = $_GET['company'];
        echo $company;
    ?>
</body>
</html>