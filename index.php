<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>Charity Events</title>
</head>
<body>
        <section>
            <h4>Language selection</h4>
            <div id="google_translate_element"></div> <!-- Google Translate widget will appear here -->  
        </section>

    <header>
        
        <nav>
            <ul>
                <li><a href="SignUp.html">Sign Up</a></li>
                <li><a href="Login.html">Login</a></li>
                <?php
                require_once 'isAdmin.php';
                if ($admin == true) {
                    echo "<li><a href='Events.php'>Admin</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
       
        
        
        <section>
            <h2>Events for you</h2>
            <ul>
            <?php
            require 'Database.php';

            try {
                $conn = getConnection();
                $sql = "SELECT eventname, description, location, capacity FROM em_events";

                $result = $conn->query($sql);

                //checking if the query executed successfully
                if ($result) {

                    $events = $result->fetchAll(PDO::FETCH_ASSOC);

                    if (count($events) > 0) {
                        foreach ($events as $event) {
                            echo "<li>";
                            echo "<span class='event-name'>" . $event["eventname"] . "</span><br>";
                            echo "<span class='event-details'>description: " . $event["description"] . "</span><br>";
                            echo "<span class='event-details'>location: " . $event["location"] . "</span><br>";
                            echo "<span class='event-details'>avaliable spaces: " . $event["capacity"] . "</span>";
                            echo "<a href='#' class='book-btn'>Book</a>";
                            echo "</li>";
                        }
                        
                    } else {
                        echo "sorry, no events currently";
                    }
                } else {
                    echo "error executing query";
                }
            } catch(PDOException $e) {
                // If there is an error, display an error message
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
