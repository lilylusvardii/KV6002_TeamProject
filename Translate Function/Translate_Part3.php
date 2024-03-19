<!DOCTYPE html>
            <html lang="en-US">
            <body>

            <p id="textField">You can translate the content of this page by selecting a language in the select box.</p>

            <h1 id="title">My Web Page</h1>

            <p>Hello everybody!</p>

            <p>Translate this page:</p>

            <div id="google_translate_element"></div>

            <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'zh-CN,cs,da,nl,en,et,fr'}, 'google_translate_element');
            }

            </script>

            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


            </body>
            </html>