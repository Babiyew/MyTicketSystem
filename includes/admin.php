<?php
session_start();
require_once "auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="/MyTicketSystem/style.css">
</head>
<body>

<?php require_once __DIR__ . "/nav.php"; ?>

<div class="container">
  <div class="card">
    <h1>Admin Dashboard</h1>
    <div class="success">✅ Admin access confirmed.</div>

    <p class="small">Admin tools (next step):</p>
    <ul>
      <li>Manage users (activate/deactivate, roles)</li>
      <li>View all tickets across branches</li>
      <li>Reports / exports</li>
      <li>System settings</li>
    </ul>
  </div>
</div>

</body>
</html>
