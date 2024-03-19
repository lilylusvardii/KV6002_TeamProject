<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Events</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="SignUp.html">Sign Up</a></li>
                <li><a href="Login.html">Login</a></li>
                <li><a href="Events.html">Event management</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <section>
            <h2>Language selection</h2>
            
        </section>
        <section>
                <h2>Events for you</h2>
                <ul>
                    <?
                    include 'Database.php' ;

                    $sql = "SELECT eventname, description, location, capacity FROM em_events"; 
                    $result = $conn->query($sql);

                    //need to filter based on incomes
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["eventname"] . ": $" . $row["description"] . ": $" . $row["location"] . ": $" . $row["capacity"] ."</li>";
                    }
                } else { 
                    echo "Sorry, there aren't any avaliable events";
                } 
                $conn->close();
                ?>
                </ul>
        </section>
    </main>

</body>
</html>