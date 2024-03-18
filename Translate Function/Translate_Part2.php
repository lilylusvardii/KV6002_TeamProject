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
    $apiKey = 'YOUR_API_KEY';  // Replace with your actual API key. Consider using environment variables for better security
    $text = $_POST["text"];
    $targetLanguage = $_POST["language"];

    $translatedText = translateText($text, $targetLanguage, $apiKey);
    echo "<p>Translated text: " . htmlspecialchars($translatedText, ENT_QUOTES, 'UTF-8') . "</p>";
}
?>