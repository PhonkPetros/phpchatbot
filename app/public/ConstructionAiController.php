<?php
require_once 'ConstructionAiModel.php';
header('Content-Type: application/json');
error_reporting(E_ALL);

class ConstructionAiController {
    private $chatGPTApi;

    public function __construct() {
        $this->chatGPTApi = new ConstructionAIModel('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'); 
    }

    public function sendMessage($message) {
        if (!empty($message)) {
            $response = $this->chatGPTApi->getResponse($message);
            return json_encode($response);
        } else {
            return json_encode(['error' => 'Message is empty']);
        }
    }
}

$controller = new ConstructionAiController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $message = trim($_POST['message']);
    $response = $controller->sendMessage($message);
    echo $response;
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
