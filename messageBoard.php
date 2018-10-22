<!DOCTYPE html>
<html lang="en">
<head>
   <!--
      Exercise 02_06_01
      Author: Daniel Truong
      Date:   10.22.18

      Filename: messageBoard.php
   -->
   <meta charset="utf-8" />
   <meta name="viewport" content="width=page-width, initial-scale=1.0">
   <title>Message Board</title>
   <link rel="stylesheet" href="snoot.css" />
   <link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
   <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h1>Message Board</h1>
    <?php
    if (isset($_GET['action'])) {
        if (file_exists("messages.txt") || filesize("messages.txt") != 0) {
            $messageArray = file("messages.txt");
            //Delete the messages
            switch ($_GET['action']) {
                case 'Delete First':
                    array_shift($messageArray);
                    break;
            } if (count($messageArray) > 0) {
                echo "There are remaining messages in the array.<br>"; //Debug
            } else {
                unlink("messages.txt");
            }
            
        }
    }
    if (!file_exists("messages.txt") || filesize("messages.txt") == 0) {
        echo "<p>There are no messages posted</p>\n";
    } else {
        $messageArray = file("messages.txt");
        //Starts table
        echo "<table style=\"background-color: lightgray\" border=\"1\" width=\"100%\">\n";
        $count = count($messageArray);
        for ($i=0; $i < $count; $i++) { 
            $currMessage = explode("~", $messageArray[$i]);
            //Looping and creatig table rows
            echo "<tr>";
            echo "<td width=\"5%\" style=\" text-align: center; font-weight: bold\">" . ($i + 1) . "</td>";
            echo "<td width=\"95%\"><span style=\"font-weight:bold\">Subject: </span>" . htmlentities($currMessage[0]) ."<br>\n";
            echo "<span style=\"font-weight: bold\">Name: </span>" . htmlentities($currMessage[1]) . "<br>\n";
            echo "<span style=\"font-decoration: underline; font-weight: bold\">Message: </span>" . htmlentities($currMessage[2]) . "</td>\n";
            echo "</tr>";
        }
        //Ends table
        echo "</table>";
    }
        
    ?>
    <p>
        <a href="postMessage.php">Post new message</a><br>
        <a href="messageBoard.php?action=Delete%20First">Delete First Message</a>
    </p>
</body>
</html>