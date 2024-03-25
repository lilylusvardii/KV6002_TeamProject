<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Event Management</title>
</head>
<body>
    <main>
    <section>
        <h4>Language selection</h4>
        <div id="google_translate_element"></div> <!-- Google Translate widget will appear here -->  
    </section>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="SignUp.php">Sign Up</a></li>
                <li><a href="Login.php">Login</a></li>

            </ul>
        </nav>
    </header>
    <!-- adding events subsystem -->
        
    <h2>Add Event</h2> <!-- add events form -->
    <form action="addEvents.php" method="POST">
        <label for="eventName">Event Name:</label><br>
        <input type="text" id="eventName" name="eventName" required><br><br>

        <label for="desc">Description:</label><br>
        <input type="text" id="desc" name="desc" required><br><br>

        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" required><br><br>

        <label for="capacity">Capacity:</label><br>
        <input type="number" id="capacity" name="capacity" required><br><br>
       
        <label for="incomeGroup">choose income group: </label> <!-- multiple choice option for income groups -->
        <select id="incomeGroup" name="incomeGroup">
            <option value="1">0-4500: </option>
            <option value="2">4501-5500: </option>
        </select>
        <br><br>

        <label for="date">Date (in the format DD/MM/YYYY):</label><br> <!-- suggested format, no validation on backend yet -->
        <input type="text" id="date" name="date" required><br><br>

        <input type="submit" value="Add Event">
    </form>

    <h2>Delete Event</h2>
    <form action="deleteEvents.php" method="POST"> <!-- deleting events form - drop down list -->
        <label for="event_id">select event to delete:</label><br>
        <select id="event_id" name="event_id">
            <?php
            include 'Database.php';
            $conn = getConnection(); //db connection
            $sql = "SELECT event_id, eventname FROM em_events"; //sql to get events from table
            $stmt = $conn->prepare($sql); //preparing sql statement
            $stmt->execute(); //executing sql statement

            $events = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetching the events as an associative array
            if (!empty($events)) { //checking that the array of events isnt empty
                foreach ($events as $event) { //looping through and displaying each event in drop down
                    echo "<option value='" . $event["event_id"] . "'>" . $event["eventname"] . "</option>"; //populating dropdown 
                }
            } else {
                echo "<option disabled>no events found</option>"; //displaying message if no events found
            }

            $conn = null; //closing db connection

            ?>

        </select>
        <br><br>
        <input type="submit" value="Delete Event">
    </form>
   
    </main>

     <!-- Google Translate -->
     <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'zh-CN,ms,es,en,fr',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!-- End Google Translate -->

</body>
</html>
