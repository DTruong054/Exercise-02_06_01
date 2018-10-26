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
    /* input styles */
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
    <?php
    //Grab any URL that has 'action'
    if (isset($_GET['action'])) {
        if (file_exists("guest.txt") || filesize("guest.txt") != 0) {
            $nameArray = file("guest.txt");
            //Delete the visitors
            switch ($_GET['action']) {
                case 'Delete First':
                    array_shift($nameArray);
                    break;
                case 'Delete Last':
                    array_pop($nameArray);
                    break;
                case 'Delete Message':
                    if (isset($_GET['message'])) {
                        array_splice($nameArray, $_GET['message'], 1);
                    }
                    break;
                case 'Sort Ascending':
                    sort($nameArray);
                    break;
                case 'Sort Descending':
                    rsort($nameArray);
                    break;
            } if (count($nameArray) > 0) {
                //If there are still messsages
                $newNameArray = implode($nameArray);
                $fileHandle = fopen("guest.txt", "wb");
                if (!$fileHandle) {
                    echo "There was an error updating the message file.\n";
                } else {
                    fwrite($fileHandle, $newNameArray);
                    fclose($fileHandle);
                }
            } else {
                unlink("guest.txt");
            }
        }
    }
        if (!file_exists("guest.txt") || filesize("guest.txt") == 0) {
            echo "<p>There are no visitors</p>\n";
        } else {
            $nameArray = file("guest.txt");
            //Starts table
            echo "<div>";
            echo "<table style=\"background-color: rgb(255,250,240)\" border=\"1\" width=\"100%\">\n";
            $count = count($nameArray);
            for ($i=0; $i < $count; $i++) { 
                $currMessage = explode("|", $nameArray[$i]);
                $keyNameArray[$currMessage[0]] = $currMessage[1];
            }
            $index = 1;
            $key = key($keyNameArray);
            foreach ($keyNameArray as $visitor) { 
                $currMessage = explode("|", $visitor);
                //Looping and creating table rows
                echo "<tr>";
                echo "<td width=\"5%\" style=\" text-align: center; font-weight: bold\">" . $index . "</td>";
                echo "<td width=\"85%\"><span style=\"font-weight:bold\">Name: </span>" . htmlentities($key) ."<br>\n";
                echo "<span style=\"font-weight: bold\">Email: </span>" . htmlentities($currMessage[0]) . "<br>\n";
                echo "<td width=\"10%\" style=\"text-align: center\">" . "<a href='guestBook.php?" . "action=Delete%20Message&" . "message" . ($index-1) ."class='button'"."'>" . "Delete this visitor</a></td>\n";
                echo "</tr>\n";
                ++$index;
                next($keyNameArray);
                $key = key($keyNameArray);
            }
            //Ends table
            echo "</table>";
        }
    ?>
    <p>
        <!-- Links back to the other page -->
        <a href="postGuest.php" class="button">Add new visitor</a><br>
        <a href="guestBook.php?action=Sort%20Ascending" class="button">Sort Name Ascending</a><br>
        <a href="guestBook.php?action=Sort%20Descending" class="button">Sort Name Decsending</a><br>
        <a href="guestBook.php?action=Delete%20First" class="button">Delete First visitor</a><br>
        <a href="guestBook.php?action=Delete%20Last" class="button">Delete Last visitor</a><br>
    </p>
    </div>
</body>
</html>