<?php
require_once __DIR__ . "/auth.php";
require_login(['admin','staff','volunteer','member']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Member Dashboard</title>
  <link rel="stylesheet" href="/MyTicketSystem/style.css">
</head>
<body>

<?php require_once __DIR__ . "/nav.php"; ?>

<div class="container">
  <div class="card">
    <h1>Member Dashboard</h1>
    <div class="success">✅ Member access confirmed.</div>

    <p class="small">Member tools (next step):</p>
    <ul>
      <li>Create a ticket</li>
      <li>View own tickets only</li>
      <li>Track ticket status</li>
    </ul>
  </div>
</div>

</body>
</html>
