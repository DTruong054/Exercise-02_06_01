<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <form action="postGuest.php" method="post">
        <!-- Forms -->
        <input type="text" name="name" placeholder="Name"><br>
        <input type="text" name="email" placeholder="E-mail"><br>
        <!-- Form buttons -->
        <input type="reset" name="reset" value="Reset Form">
        <input type="submit" name="submit" value="Post Message">
    </form>
    <?php
        if (isset($_POST['submit'])) {
            $name = stripslashes($_POST['name']);
            $email = stripslashes($_POST['email']);
            $existingName = array();

            //If same name 
            if (in_array($name, $existingName)) {
                # code...
            }
        }
    ?>
</body>
</html>