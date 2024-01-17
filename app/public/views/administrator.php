<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-up-r.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/trash.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/arrow-down-r.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/admin.css">
    <title>ConstructionAI</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">ConstructionAI</a>
            <form method="POST" action="">
                <button class="navbar-brand admin-button" type="submit" name="chat">Chat</button>
            </form>
        </div>
        <div>
            <form method="POST" action="">
                <button class="navbar-brand logout-button" type="submit" name="logout">Logout</button>
            </form>
        </div>
    </nav>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">Username</th>
      <th scope="col">Role</th>
      <th scope="col">Query Count</th>
      <th scope="col">Query Date</th>
      <th scope="col">Delete User</th>
      <th scope="col">Promote User</th>
      <th scope="col">Demote User</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <th scope="row"><?= $user['id'] ?></th>
      <td><?= $user['username'] ?></td>
      <td><?= $user['role'] ?></td>
      <td><?= $user['query_count'] ?></td>
      <td><?= $user['query_date'] ?></td>
      <td>
        <form method="POST" action="">
          <input type="hidden" name="delete" value="<?= $user['username'] ?>">
          <button class="delete-button" type="submit"><i class="gg-trash"></i></button>
        </form>
      </td>
      <form method="POST" action="">
        <input type="hidden" name="promote" value="<?= $user['username'] ?>">
        <td><button class="promote-button"><i class="gg-arrow-up-r"></i></button></td>
      </form>
        <form method="POST" action="">
            <input type="hidden" name="demote" value="<?= $user['username'] ?>">
            <td><button class="demote-button"><i class="gg-arrow-down-r"></i></i></button></td>
        </form>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<div class="wrapper">
  <form method="POST" action="">
    <div class="mb-3">
      <label for="apiKey" class="form-label">API Key</label>
      <input type="text" class="form-control" id="apiKey" name="apiKey" value="<?php echo htmlspecialchars($apiKey); ?>">
    </div>
    <div class="mb-3">
      <label for="prePrompt" class="form-label">Set Prompt</label>
      <textarea class="form-control" id="prePrompt" name="prePrompt" rows="3" placeholder="Set a prompt to start the messages users can't see the prompt"><?php echo htmlspecialchars($prePrompt); ?></textarea>
    </div>
    <button type="submit" name="saveApiSettings" class="btn btn-primary">Save</button>
  </form>
</div>
</body>
</html>
