<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-up-r.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/chat.css">
    <script src="js.js"></script>
    <title>ConstructionAI</title>
</head>
<body>
<div class="nav-bar-container">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">ConstructionAI</a>
            <form method="POST" action="">
                <button class="navbar-brand logout-button" type="submit" name="logout">Logout</button>
                <button class="navbar-brand admin-button" type="submit" name="administrator">Administrator</button>
            </form>
        </div>
    </nav>
</div>

    <div class="container-role">
        <div class="user-info">
            <p>Welcome, <?php echo $username?> your role is <?php echo $role?>.</p>
        </div>
    </div>
   
    <div class="container">
    <div class="chatbox">
        <div id="responseContainer" class="chatbox-content"></div>
    </div>
    <div class="chat-input">
        <form id="chatForm" method="POST">
            <input type="text" id="messageInput" name="message" class="form-control" placeholder="Enter a message">
            <button type="submit">Send</button>
        </form>
    </div>
</div>
</body>
</html>

