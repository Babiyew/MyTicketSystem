<?php
session_start();
require_once __DIR__ . "/includes/db.php";

$error = "";

// If already logged in, go to dashboard
if (isset($_SESSION["user_id"])) {
  header("Location: /MyTicketSystem/includes/dashboard.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $login    = trim($_POST["username"] ?? ""); // can be username OR email
  $password = trim($_POST["password"] ?? "");

  if ($login === "" || $password === "") {
    $error = "Please enter username/email and password.";
  } else {

    // If your users table has email column, this supports both username OR email.
    // If you don't have email column, it will still work using username only.
    $sql = "
      SELECT id, username, role, status
      FROM users
      WHERE (username = ? OR (COLUMN_EXISTS = 1 AND email = ?))
        AND password = SHA2(?,256)
      LIMIT 1
    ";

    // ---- detect if email column exists (safe) ----
    $hasEmail = 0;
    $check = $conn->query("SHOW COLUMNS FROM users LIKE 'email'");
    if ($check && $check->num_rows > 0) $hasEmail = 1;

    // build real query based on email existence
    if ($hasEmail === 1) {
      $stmt = $conn->prepare("SELECT id, username, role, status FROM users WHERE (username=? OR email=?) AND password = SHA2(?,256) LIMIT 1");
      $stmt->bind_param("sss", $login, $login, $password);
    } else {
      $stmt = $conn->prepare("SELECT id, username, role, status FROM users WHERE username=? AND password = SHA2(?,256) LIMIT 1");
      $stmt->bind_param("ss", $login, $password);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
      // if status column is missing, treat as active
      $status = $row["status"] ?? "active";

      if ($status !== "active") {
        $error = "Your account is inactive.";
      } else {
        $_SESSION["user_id"]  = (int)$row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"]     = $row["role"] ?? "member";

        header("Location: /MyTicketSystem/includes/dashboard.php");
        exit;
      }
    } else {
      $error = "Invalid username/email or password.";
    }

    $stmt->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="/MyTicketSystem/style.css">
</head>
<body>

  <?php require_once __DIR__ . "/includes/nav.php"; ?>

  <div class="center-page">
    <div class="card" style="max-width:520px; width:100%;">
      <h1>Login</h1>

      <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <form method="POST" autocomplete="off">
        <div>
          <label>Username or Email</label>
          <input name="username" type="text" placeholder="Username or Email" required>
        </div>

        <div>
          <label>Password</label>
          <input name="password" type="password" placeholder="Password" required>
        </div>

        <button type="submit">Login</button>

        <div class="small">
          Demo login: <b>admin</b> / <b>1234</b>
        </div>
      </form>
    </div>
  </div>

</body>
</html>


