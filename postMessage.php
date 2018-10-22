<!DOCTYPE html>
<html lang="en">
<head>
   <!--
      Exercise 02_06_01
      Author: Daniel Truong
      Date:   10.19.18

      Filename: postMessage.php
   -->
   <meta charset="utf-8" />
   <meta name="viewport" content="width=page-width, initial-scale=1.0">
   <title>Post Message</title>
   <link rel="stylesheet" href="snoot.css" />
   <link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
   <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <?php
        //How got here?
        if (isset($_POST['submit'])) {
            $subject = stripslashes($_POST['subject']);
            $name = stripslashes($_POST['name']);
            $message = stripslashes($_POST['message']);
            //Gets rid of ~ and replaces with -.
            $subject = str_replace("~", "-", $subject);
            $name = str_replace("~", "-", $name);
            $message = str_replace("~", "-", $message);
            //Stores message
            $messageRecord = "$subject~$name~$message\n";
            $fileHandle = fopen("messages.txt", "ab");
            if (!$fileHandle) {
                //File handle is false
                echo "There was an error saving your message!\n";
            } else {
                //File handle is true
                fwrite($fileHandle, $messageRecord);
                fclose($fileHandle);
                echo "Your message has been saved.\n";
            }
            
        }
    ?>
    <h1>Post New Message</h1>
    <hr>
    <form action="postMessage.php" method="post">
        <span style="font-weight: bold">Subject:  <input type="text" name="subject"></span>
        <span style="font-weight: bold">Name:  <input type="text" name="name"></span><br>
        <textarea name="message" cols="80" rows="6" style="margin:10px 5px 5px"></textarea><br>
        <input type="reset" name="reset" value="Reset Form">
        <input type="submit" name="submit" value="Post Message">
    </form>
    <hr>
    <p>
        <a href="messageBoard.php">View Message</a>
    </p>
</body>
</html>