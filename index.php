<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <li><a href="Events.html">Event Management</a></li>
            </ul>
        </nav>
    </header>
    <main>
       
        
        
        <section>
            <h2>Events for you</h2>
            <ul>
                <?
                    require 'Database.php' ;
                    $sql = "SELECT eventname, description, location, capacity FROM em_events"; 
                    try {
                        // Create a database connection and execute the query
                        $dbConnection = getConnection();
                        $result = $dbConnection->query($sql);
                     
                        // Fetch all the data as an associative array
                        $data = $result->fetchAll(PDO::FETCH_ASSOC);
                     
                    } catch( PDOException $e ) {
                        // If there is an error, return an error message in JSON format
                        $error['error'] = "Database Query Error";
                        $error['message'] = $e->getMessage();
                     
                        $data = $error;
                    }
                    
                    

                    /*need to filter based on incomes
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["eventname"] . ": $" . $row["description"] . ": $" . $row["location"] . ": $" . $row["capacity"] ."</li>";
                    }
                    } else { 
                    echo "Sorry, there aren't any avaliable events";
                    }  */       
                    
                    if ($result != 0 ) { 
                        echo $row["eventname"]; 
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