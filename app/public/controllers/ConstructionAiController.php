<?php
require_once __DIR__ . '/../models/ConstructionAiModel.php';
require_once __DIR__ . '/../repositories/MessageRepository.php';

header('Content-Type: application/json');

$controller = new ConstructionAiController();

class ConstructionAiController {
    private $chatGPTApi;
    private $messageRepository;

    
    public function __construct() {
        $this->messageRepository = new MessageRepository();
        $this->chatGPTApi = new ConstructionAIModel();

        $apiSettings = $this->messageRepository->getApiSettings();
        if (isset($apiSettings['api_key'])) {
            $this->chatGPTApi->setApiKey($apiSettings['api_key']);
        }
        if (isset($apiSettings['pre_prompt'])) {
            $this->chatGPTApi->setPrompt($apiSettings['pre_prompt']);
        }
    }


    

    public function sendMessage($message) {
        try {
            if (!empty($message)) {
                $prompt = $this->chatGPTApi->getPrompt();
                $combinedMessage = $prompt . "\n" . $message;
                $response = $this->getResponse($combinedMessage);

                $this->messageRepository->insertMessageIntoDatabase($_SESSION['user_id'], $message, $response['choices'][0]['message']['content']);

                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Message is empty']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getResponse($prompt) {
        $url = 'https://api.openai.com/v1/chat/completions';

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

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->chatGPTApi->getApiKey(),
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $message = trim($_POST['message']);
    session_start();
    $controller->sendMessage($message);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
