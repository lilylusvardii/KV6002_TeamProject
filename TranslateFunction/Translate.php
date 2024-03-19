<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

function translateText($text, $targetLanguage, $apiKey) {
    $client = new Client();

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
}

// Usage example
$apiKey = 'YOUR_API_KEY'; // Replace with your actual API key
$text = 'Hello, world!';
$targetLanguage = 'es'; // Spanish

try {
    $translatedText = translateText($text, $targetLanguage, $apiKey);
    echo "Translated text: " . $translatedText;
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
