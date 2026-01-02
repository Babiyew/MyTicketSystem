<?php
require_once __DIR__ . "/auth.php";
requireAnyRole(['admin', 'staff']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Staff Dashboard</title>
  <link rel="stylesheet" href="/MyTicketSystem/style.css">
</head>
<body>

<?php require_once __DIR__ . "/nav.php"; ?>

<div class="container">
  <div class="card">
    <h1>Staff Dashboard</h1>
    <div class="success">✅ Staff access confirmed.</div>

    <p class="small">Staff tools (next step):</p>
    <ul>
      <li>View assigned tickets</li>
      <li>Change ticket status</li>
      <li>Add internal notes</li>
    </ul>
  </div>
</div>

</body>
</html>
