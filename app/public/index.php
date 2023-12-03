<?php 
require_once './models/User.php';
require_once 'database.php';

$_POST = filter_input_array(INPUT_POST);

$db = new Database();
$userModel = new User($db);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $userModel->login($username, $password);

    if ($user) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $error = "Valid username and password";
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConstuctionAI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
</head>
<body>
<form class="centered-form" method="POST">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
      <?php echo htmlspecialchars($error); ?>
    </div>
  <?php endif; ?>
  <div class="login-pos">
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="register.php" class="btn btn-link">Register</a>
  </div>
</form>
</body>
</html>
