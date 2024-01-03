<?php
class ConstructionAIModel {
    private $apiKey;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function getResponse($prompt) {
        // The URL of the AI service API endpoint
        $url = 'https://api.openai.com/v1/chat/completions';

        // The data you want to send in the API request
        $data = [
            "model" => "gpt-3.5-turbo",
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'max_tokens' => 150,
        ];

        // Set up the HTTP headers
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey,
        ];

        // Initialize a cURL session
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute the cURL session and get the response
        $response = curl_exec($ch);

        // Check for errors and handle them
        if(curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        // Close the cURL session
        curl_close($ch);

        // Decode the JSON response and return it
        return json_decode($response, true);
    }
}
?>
