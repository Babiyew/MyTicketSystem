<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Ticket System - Home</title>
  <link rel="stylesheet" href="/MyTicketSystem/style.css">
</head>
<body>

<?php require_once __DIR__ . "/includes/nav.php"; ?>

<div class="container">
  <div class="card">
    <h1>Welcome</h1>
    <p>This is a simple Ticket System demo running on XAMPP.</p>

    <?php if (!isset($_SESSION['user_id'])): ?>
      <p>Click <b>Login</b> to test the demo account.</p>
      <p class="small">Demo login: <b>admin@test.com</b> / <b>1234</b></p>
    <?php else: ?>
      <p class="success">You are logged in.</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
