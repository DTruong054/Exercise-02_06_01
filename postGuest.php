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
            $name = str_replace("|", "/", $name);
            $email = str_replace("|" , "/", $email);
            $existingName = array();

        if (file_exists('guest.txt') && filesize('guest.txt') > 0) {
            $nameArray = file("guest.txt");
            $count = count($nameArray);
            for ($i=0; $i < $count; $i++) { 
                $currMessage = explode("|", $nameArray[$i]);
                $existingName[] = $currMessage[0];
            }
        }

            //If same name 
            if (in_array($name, $existingName)) {
                echo "The name \"$name\" already exists, enter a new name and try again";
            } else{
                //Stores message
                $storeVisitor = "$name|$email\n";
                $fileHandle = fopen("guest.txt", "ab");
                if (!$fileHandle) {
                //File handle is false
                    echo "There was an error saving your message!\n";
                } else {
                //File handle is true
                    fwrite($fileHandle, $storeVisitor);
                    fclose($fileHandle);
                    echo "Your message has been saved.\n";
                    $name = "";
                    $email = "";
                }
            }
        } else {
            $subject = "";
            $name = "";
            $message = "";
        }
    ?>
    <p>
        <a href="guestBook.php">View Guests</a>
    </p>
</body>
</html>