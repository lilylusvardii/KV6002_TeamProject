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
                    $sql = "SELECT eventname, description, location, capacity FROM em_events"; 
                    try {
                        // Create a database connection and execute the query
                        $dbConnection = getConnection();
                        $result = $dbConnection->query($sql);
                     
                        // Fetch all the data as an associative array
                        $data = $result->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($data as $row) {
                            echo "<li>" . $row["eventname"] . ": " . $row["description"] . ": " . $row["location"] . ": " . $row["capacity"] . "</li>";
                        }
                    } catch( PDOException $e ) {
                        // If there is an error, return an error message in JSON format
                        $error['error'] = "Database Query Error";
                        $error['message'] = $e->getMessage();
                     
                        $data = $error;
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
