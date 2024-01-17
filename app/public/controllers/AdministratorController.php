<?php
require_once './repositories/AdministratorRepository.php';
require_once './models/AdministratorModel.php';
require_once './models/ConstructionAiModel.php';
require_once './repositories/MessageRepository.php';
class AdministratorController {
    

    private $adminRepo;
    private $messageRepository;


    public function __construct() {
        $this->adminRepo = new AdministratorRepository();
        $this->messageRepository = new MessageRepository();
    }

    public function loginAdministrator($username, $password) {
        if ($username && $password == null){
            return false;
        }

        $admin = $this->adminRepo->getAdminByUsername($username);

        if ($admin && password_verify($password, $admin['password'])) {
            if ($admin['role'] == 'Administrator') {
                return $admin;
            }
        }

        return false;
    }
    
    public function show() {
        session_start();
        $username = $_SESSION['username'];

        $constructionModel = new ConstructionAiModel();



        if ($_SESSION['role'] != "Administrator") {
            header('Location: /chat');
            exit;
        }




        $users = $this->adminRepo->getAllUsersWithQueries();

        $apiSettings = $this->messageRepository->getApiSettings();

        $apiKey = $apiSettings['api_key'] ?? 'API Key not set';
        $prePrompt = $apiSettings['pre_prompt'] ?? 'Prompt not set';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    
            $apiKey = $_POST['apiKey'];
            $prePrompt = $_POST['prePrompt'];
    
            $constructionModel->setApiKey($apiKey);
            $constructionModel->setPrompt($prePrompt);
    
            header('Location: /administrator');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete'])) {
                $usernameToDelete = $_POST['delete'];
                
                $result = $this->adminRepo->removeUser($usernameToDelete);
                
                if ($result) {
                    header('Location: /administrator');
                    exit;
                } else {
                    echo "Something went wrong";
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['promote'])) {
                $usernameToPromote = $_POST['promote'];
                
                $result = $this->adminRepo->promoteUser($usernameToPromote);
                
                if ($result) {
                    header('Location: /administrator');
                    exit;
                } else {
                    echo "Something went wrong";
                }
            }
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['demote'])) {
                $usernameToDemote = $_POST['demote'];
                if ($usernameToDemote === $username) {
                    session_unset();
                    session_destroy();
                    $result = $this->adminRepo->demoteUser($usernameToDemote);
                    header('Location: /');
                    exit;
                } else {
                    $result = $this->adminRepo->demoteUser($usernameToDemote);
        
                    if ($result) {
                        header('Location: /administrator');
                        exit;
                    } else {
                        echo "Something went wrong";
                    }
                }
            }
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['saveApiSettings'])) {
                $apiKey = $_POST['apiKey'];
                $prePrompt = $_POST['prePrompt'];
                
                $result = $this->messageRepository->updateApiSettings($apiKey, $prePrompt);
                
                if ($result) {
                    header('Location: /administrator');
                    exit;
                } else {
                    echo "Something went wrong";
                }
            }
           
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
          session_unset();
          session_destroy();
          header('Location: /');
          exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['chat'])) {
            header('Location: /chat');
            exit;
        }

        require __DIR__ . '/../views/administrator.php';
    }
}