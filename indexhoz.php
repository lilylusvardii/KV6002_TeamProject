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
        <?php
        // Start session
        session_start();

        // Check if user is logged in as admin
        $isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false;
        ?>
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
                $conn = getConnection();
                $sql = "SELECT eventname, description, location, capacity, date FROM em_events";//sql statement to get events

                $result = $conn->query($sql);//executing query

                if ($result) {
                    $events = $result->fetchAll(PDO::FETCH_ASSOC);

                    if (count($events) > 0) {
                        foreach ($events as $event) {//displaying events
                            echo "<li>";
                            echo "<span class='event-name'>" . htmlspecialchars($event["eventname"], ENT_QUOTES) . "</span><br>";
                            echo "<span class='event-details'>description: " . htmlspecialchars($event["description"], ENT_QUOTES) . "</span><br>";
                            echo "<span class='event-details'>location: " . htmlspecialchars($event["location"], ENT_QUOTES) . "</span><br>";
                            echo "<span class='event-details'>available spaces: " . htmlspecialchars($event["capacity"], ENT_QUOTES) . "</span><br>";
                            echo "<span class='event-details'>date: " . htmlspecialchars($event["date"], ENT_QUOTES) . "</span><br>";
                            echo "<a href='booking.php' class='book-btn'>click to book</a>"; //link to book
                            echo "</li>";
                        }
                    } else {
                        echo "Sorry, no events currently.";//if no events are in db 
                    }
                } else {
                    echo "Error executing query.";//error handling
                }
            } catch(PDOException $e) {
                echo "Database error: " . $e->getMessage();
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

    <!-- Booking Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.book-btn').forEach(button => {
                button.onclick = function() {
                    const eventName = this.getAttribute('data-eventname');
                    const phoneNumber = prompt("Please enter your phone number to book:");

                    if (phoneNumber) {
                        fetch('http://localhost:3002/bookEvent', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ phone: phoneNumber, eventName: eventName }),
                        })
                        .then(response => response.json())
                        .then(data => alert(data.message))
                        .catch(error => console.error('Error:', error));
                    } else {
                        alert('Phone number is required to book an event.');
                    }
                };
            });
        });
    </script>
</body>
</html>
