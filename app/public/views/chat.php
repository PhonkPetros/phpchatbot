<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: /');
  exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //TODO: THIS NEEDS TO BE JAVASCRIPT Since we are not interacting with the server
  if (isset($_POST['gg-arrow-up'])) {
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header('Location: /');
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-up-r.css' rel='stylesheet'>
  <link rel="stylesheet" href="chat.css">
  <title>ConstuctionAI</title>
</head>
<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand">ConstuctionAI</a>
        <form method="POST" action="">
          <button class="navbar-brand admin-button" type="submit" name="administration">Administrator</button>
        </form>  
      </div>
      <div>
      <form method="POST" action="">
          <button class="navbar-brand logout-button" type="submit" name="logout">Logout</button>
        </form>      
      </div>
    </nav>
  </div>
  </div>

  <div class="container">
    <div class="user-info">
      <p>Welcome, <?php echo $username?> your role is <?php echo $role?>.</p>
    </div>
  </div>
  <div class="container">
    <div class="input-box"></div>
    <div class="input-group mb-3">
      <form method="POST" action="">
        <input type="text" class="form-control" placeholder="Enter a message" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit" name="gg-arrow-up"><i class="gg-arrow-up-r"></i></button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
