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
   <link href='http://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
   <!-- <script src="modernizr.custom.65897.js"></script> -->
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
                case 'Delete Last':
                    array_pop($messageArray);
                    break;
                case 'Delete Message':
                    if (isset($_GET['message'])) {
                        array_splice($messageArray, $_GET['message'], 1);
                    }
                    break;
                case 'Remove Duplicates':
                    $messageArray = array_unique($messageArray);
                    $messageArray = array_values($messageArray);
                    break;
            } if (count($messageArray) > 0) {
                //If there are still messsages
                $newMessageArray = implode($messageArray);
                $fileHandle = fopen("messages.txt", "wb");
                if (!$fileHandle) {
                    echo "There was an error updating the message file.\n";
                } else {
                    fwrite($fileHandle, $newMessageArray);
                    fclose($fileHandle);
                }
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
            $keyMessageArray[$currMessage[0]] = $currMessage[1] . "~" . $currMessage[2];
        }
        $index = 1;
        $key = key($keyMessageArray);
        foreach ($keyMessageArray as $message) { 
            $currMessage = explode("~", $message);
            //Looping and creatig table rows
            echo "<tr>";
            echo "<td width=\"5%\" style=\" text-align: center; font-weight: bold\">" . $index . "</td>";
            echo "<td width=\"85%\"><span style=\"font-weight:bold\">Subject: </span>" . htmlentities($key) ."<br>\n";
            echo "<span style=\"font-weight: bold\">Name: </span>" . htmlentities($currMessage[0]) . "<br>\n";
            echo "<span style=\"font-decoration: underline; font-weight: bold\">Message: </span>" . htmlentities($currMessage[1]) . "</td>\n";
            echo "<td width=\"10%\" style=\"text-align: center\">" . "<a href='messageBoard.php?" . "action=Delete%20Message&" . "message" . ($index-1) ."'>" . "Delete this message</a></td>\n";
            echo "</tr>\n";
            ++$index;
            next($keyMessageArray);
            $key = key($keyMessageArray);
        }
        //Ends table
        echo "</table>";
    }
        
    ?>
    <p>
        <a href="postMessage.php">Post new message</a><br>
        <a href="messageBoard.php?action=Delete%20First">Delete First Message</a> <br>
        <a href="messageBoard.php?action=Delete%20Last">Delete Last Message</a> <br>
        <a href="messageBoard.php?action=Remove%20Duplicates">Remove Duplicates</a> <br>
    </p>
</body>
</html>

<?php
    // Mary had a little lamb little lam little lamb, mary had a little lamb that ate her too
?>