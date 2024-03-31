<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Charity Events</title>
</head>
<body>
    <?php
    //part of adding events subsystem
        session_start();
        //checking if user is admin
        $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : true;
    ?>
        <section>
            <h4>Language selection</h4>
            <div id="google_translate_element"></div> <!-- Google Translate widget will appear here -->  
        </section>

    <header>
        <nav>
            <ul>
                <li><a href="signuphoz.html">Sign Up</a></li>
                <li><a href="Login.html"> Login</a></li>
            <?php if ($isAdmin): ?>
                <li><a href='Events.php'> Events Management</a></li>
            <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
       
        
        
        <section>
            <h2>Current Events</h2>
            <!-- part of the adding events subsystem -->
            <ul>
            <?php
            require 'Database.php';

            try {
                $conn = getConnection(); //db connection 
                $sql = "SELECT eventname, description, location, capacity, date FROM em_events";//sql to display events

                $result = $conn->query($sql);//executing sql

                //checking if the query executed successfully
                if ($result) {

                    $events = $result->fetchAll(PDO::FETCH_ASSOC);

                    //displaying all current events
                    if (count($events) > 0) {//displaying details of all current events in db
                        foreach ($events as $event) {
                            echo "<li>";
                            echo "<span class='event-name'>" . $event["eventname"] . "</span><br>";
                            echo "<span class='event-details'>description: " . $event["description"] . "</span><br>";
                            echo "<span class='event-details'>location: " . $event["location"] . "</span><br>";
                            echo "<span class='event-details'>avaliable spaces: " . $event["capacity"] . "</span><br>";
                            echo "<span class='event-details'>date: " . $event["date"] . "</span><br>";
                            echo "<a href='booking.php' class='book-btn'>click to book</a>"; //link to book 
                            echo "</li>";
                        }
                        
                    } else {
                        echo "sorry, no events currently";//if there's no events in the db currently 
                    }
                } else {
                    echo "error executing query";
                }
            } catch(PDOException $e) {
                //error message 
                echo "database error: " . $e->getMessage();
            }
            ?>

            </ul>
        </section>
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
