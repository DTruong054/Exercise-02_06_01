<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
    if (isset($_GET['action'])) {
        if (file_exists("guest.txt") || filesize("guest.txt") != 0) {
            $nameArray = file("guest.txt");
            //Delete the visitors
            if ($_GET['action']) {
                if (conditon) {
                    array_shift($nameArray);
                }
            }
            switch ($_GET['action']) {
                case 'Delete First':
                    array_shift($nameArray);
                    echo "Delete first";
                    break;
                case 'Delete Last':
                    array_pop($nameArray);
                    echo "Delete Last";
                    break;
                case 'Delete Message':
                    if (isset($_GET['message'])) {
                        array_splice($nameArray, $_GET['message'], 1);
                    }
                    echo "Delete message";
                    break;
                case 'Sort Ascending':
                    sort($nameArray);
                    echo "Asend";
                    break;
                case 'Sort Descending':
                    rsort($nameArray);
                    echo "Desend";
                    break;
            } if (count($nameArray) > 0) {
                //If there are still messsages
                $newNameArray = implode($nameArray);
                $fileHandle = fopen("messages.txt", "wb");
                if (!$fileHandle) {
                    echo "There was an error updating the message file.\n";
                } else {
                    fwrite($fileHandle, $newNameArray);
                    fclose($fileHandle);
                }
            } else {
                unlink("messages.txt");
            }
        }
    }

    //todo Don't mess below this, all this works============================================================
        if (!file_exists("guest.txt") || filesize("guest.txt") == 0) {
            echo "<p>There are no visitors</p>\n";
        } else {
            $nameArray = file("guest.txt");
            //Starts table
            echo "<table style=\"background-color: lightgray\" border=\"1\" width=\"100%\">\n";
            $count = count($nameArray);
            for ($i=0; $i < $count; $i++) { 
                $currMessage = explode("|", $nameArray[$i]);
                $keyNameArray[$currMessage[0]] = $currMessage[1];
            }
            $index = 1;
            $key = key($keyNameArray);
            foreach ($keyNameArray as $message) { 
                $currMessage = explode("|", $message);
                //Looping and creating table rows
                echo "<tr>";
                echo "<td width=\"5%\" style=\" text-align: center; font-weight: bold\">" . $index . "</td>";
                echo "<td width=\"85%\"><span style=\"font-weight:bold\">Name: </span>" . htmlentities($key) ."<br>\n";
                echo "<span style=\"font-weight: bold\">Email: </span>" . htmlentities($currMessage[0]) . "<br>\n";
                echo "<td width=\"10%\" style=\"text-align: center\">" . "<a href='guestBook.php?" . "action=Delete%20Message&" . "message" . ($index-1) ."'>" . "Delete this visitor</a></td>\n";
                echo "</tr>\n";
                ++$index;
                next($keyNameArray);
                $key = key($keyNameArray);
            }
            //Ends table
            echo "</table>";
        }
        echo "<pre>";
        print_r($nameArray);
        echo "</pre>";
    ?>
    <p>
        <a href="postGuest.php">Add new visitor</a><br>
        <a href="guestBook.php?action=Sort%20Ascending">Sort Name Ascending</a><br>
        <a href="guestBook.php?action=Sort%20Descending">Sort Name Decsending</a><br>
        <a href="guestBook.php?action=Delete%20First">Delete First visitor</a><br>
        <a href="guestBook.php?action=Delete%20Last">Delete Last visitor</a><br>
    </p>
</body>
</html>