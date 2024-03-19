<select id="language" name="language">
    <option value="es">Spanish</option>
    <option value="fr">French</option>
    <option value="en">English</option>
    <option value="ms">Malay</option>
    <!-- Could Add more Languages -->
</select>
<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

function translateText($text, $targetLanguage, $apiKey) {
    $client = new Client();

    try {
        $response = $client->post('https://translation.googleapis.com/language/translate/v2', [
            'query' => ['key' => $apiKey],
            'json' => [
                'q' => $text,
                'target' => $targetLanguage,
            ],
        ]);

        $body = $response->getBody();
        $arr = json_decode($body, true);

        return $arr['data']['translations'][0]['translatedText'];
    } catch (Exception $e) {
        return 'Caught exception: ' . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["text"]) && !empty($_POST["language"])) {
    $apiKey = getenv('AIzaSyDwJPbBgZV1HMNGo2Pqs1hZfQDoBk7wiXk');
    $text = $_POST["text"];
    $targetLanguage = $_POST["language"];

    $translatedText = translateText($text, $targetLanguage, $apiKey);
    echo "<p>Translated text: " . htmlspecialchars($translatedText, ENT_QUOTES, 'UTF-8') . "</p>";
}
?>