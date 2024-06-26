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
                <li><a href="indexhoz.php">Home</a></li>
                <li><a href="signuphoz.html"> Sign Up</a></li>
                <li><a href="Login.html"> Login</a></li>
                <li><a href='Events.php'> Events Management</a></li>
            </ul>
        </nav>
    </header>
    <main>

        <h2>confirm booking below</h2>
        <form action="bookingConfirmed.php" method="POST">
            <input type="checkbox" id="check1" name="check1" value="confirm1">
            <label for="confirm1"> I agree I've read the terms and conditions</label><br>
            <input type="checkbox" id="check2" name="check2" value="confirm2">
            <label for="check2"> I agree that I'm okay with receiving a reminder message 24hrs beforehand</label><br>
            <input type="checkbox" id="check3" name="check3" value="confirm3">
            <label for="check3"> By booking this event I'm aware I should attend or cancel if I'm unable to go anymore</label><br><br>

            <input type="submit" value="click to confirm booking">
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
