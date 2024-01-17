<?php
require_once __DIR__ . '/../database.php';

class MessageRepository extends Database {

    public function insertMessageIntoDatabase($userId, $message, $chatbotResponse) {
        $sql = "INSERT INTO queries (user_id, query_text, chatbot_response, query_date) VALUES (?, ?, ?, NOW())";
        return $this->executeQuery($sql, [$userId, $message, $chatbotResponse]);
    }

    public function getCurrentQueryCount($userId) {
        $sql = "SELECT MAX(query_id) as max_query_id FROM queries WHERE user_id = ?";

        $result = $this->executeQuery($sql, [$userId]);

        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            return $row['max_query_id'] ?? 0;
        } else {
            return 0;
        }
    }

    public function getApiSettings() {
        $sql = "SELECT * FROM global_settings";
        $result = $this->executeQuery($sql);

        $settings = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }
    

    public function updateApiSettings($newApiKey, $newPrompt) {
        $sql = "UPDATE global_settings SET setting_value = ? WHERE setting_key = 'api_key'";
        $this->executeQuery($sql, [$newApiKey]);

        $sql = "UPDATE global_settings SET setting_value = ? WHERE setting_key = 'pre_prompt'";
        $this->executeQuery($sql, [$newPrompt]);

        return true;
    }

}
?>
