<?php
    //todo FIX THE DELETE THIS VISITOR
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<style>
    /* inputt styles */
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        input[type=reset] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }
        input[type=reset]:hover {
            background-color: #45a049;
        }
    /* div styles */
        div {
            border-radius: 5px;
            background-color: rgb(105,105,105);
            padding: 20px;
        }
    /* button styles */
        .button{
            text-decoration: none;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            display: block;
            padding: 14px 20px;
            margin: 0 auto;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        .button:hover{
            background-color: #45a049;
        }
    </style>    
    <div>
        <form action="postGuest.php" method="post">
            <!-- Forms -->
            <input type="text" name="name" placeholder="Name"><br>
            <input type="text" name="email" placeholder="E-mail"><br>
            <!-- Form buttons -->
            <input type="reset" name="reset" value="Reset Form">
            <input type="submit" name="submit" value="Post Message">
            <p>
                <a href="guestBook.php" class="button">View Guests</a>
            </p>
        </form>
    

    <?php
        if (isset($_POST['submit'])) {
            //When guest hit submit
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
    </div>
</body>
</html>