<?php
class ConstructionAIModel {
    
    private $apiKey = "";
    private $apiUrl = 'https://api.openai.com/v1/chat/completions';
    private $prePrompt = "";

    public function getApiKey() {
        return $this->apiKey;
    }

    public function setApiKey($apiKey) {
        error_log("setApiKey called with: " . $apiKey); // Debugging line
        $this->apiKey = $apiKey;
    }
    

    public function getApiUrl() {
        return $this->apiUrl;
    }

    public function setApiUrl($apiUrl) {
        $this->apiUrl = filter_var($apiUrl, FILTER_SANITIZE_URL);
    }

    public function getPrompt() {
        return $this->prePrompt;
    }

    public function setPrompt($prompt) {
        $this->prePrompt = $prompt;
    }
}


?>
